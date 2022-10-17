<?php
namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Options\Sms\BaseSms;

class ForceAuthController extends Controller
{

    public $data;
	public $user_register_status = false;
	public $status = 200;
	public $messages = [];
    public $user;


    /*
    * validate phone exsits and true with num count
    * @return boolean
    **/
    public function validatePhoneText($phone){
		if(strlen($phone) != 11 || (substr($phone,0,2) != "09" && substr($phone, 0,2) != "۰۹")){
			return false;
		}
		return true;
	}

     /*
    * validate existing phone and be true
    * @return boolean
    **/
	public function validatePhone(){
		if(!isset($this->data['phone']) || !$this->validatePhoneText($this->data['phone'])){
			$this->messages[] = [
				'input' => 'phone',
				'status' => 'invalid',
				'message' => 'لطفا تلفن همراه را به درستی وارد کنید'
			];

			return false;
		}

		$this->data['phone'] = str_replace(['۱','۲','۳','۴','۵','۶','۷','۸','۹','۰'], [1,2,3,4,5,6,7,8,9,0], $this->data['phone']);
		return true;
	}


    /*
    * get or retrun null user with phone
    * @return null|object
    **/
    public function checkUserByPhone(){
        $user = User::where('phone', $this->data['phone'])->first();
        if($user){
            $this->user_register_status = true;
        }
        return $user;
    }

    /**
     * Check for sended code message
     */
    public function checkSendedCode($code, $phone){
        if(!session()->has('send-code') || session()->get('send-code') != $code || !session()->get('send-phone') || session()->get('send-phone') != $phone) return false;
        return true;
    }


    
    public function sendCode($phone){
        $this->data['phone'] = $phone;

        $this->checkUserByPhone();
        if(!$this->validatePhone()) return response()->json([
            'messages' => $this->messages,
            'user_register_status' => $this->user_register_status,
            'status' =>  $this->status
        ]);



        $code = rand(1000,9999);
        $sms = BaseSms::sms('ghasedak')->sendByBodyId($this->data['phone'], 'register', $code);
        session()->put('send-code', $code);
        session()->put('send-phone', $this->data['phone']);
            $this->messages[] = [
				'input' => 'phone',
				'status' => 'valid',
				'message' => 'کد تایید با موفیت برای شما ارسال شد. لطفا آن را در باکس مشخص شده وارد کنید'
			];
      	
      	
        return response()->json([
            'messages' => $this->messages,
            'user_register_status' => $this->user_register_status,
            'status' =>  200
        ]);
      }

  		
   
    protected function loginCode(Request $req)
    {
    	$this->data = $req->all();
        $this->checkUserByPhone();
        $this->validatePhone();


        if(!$this->checkUserByPhone() && (!isset($this->data['name']) || !$this->data['name'])){
            $this->messages[] = [
				'input' => 'name',
				'status' => 'invalid',
				'message' => 'لطفا نام خود را وارد نمایید'
			];
        }

        if(!isset($this->data['code'])){
			$this->messages[] = [
				'input' => 'code',
				'status' => 'invalid',
				'message' => 'لطفا کد تایید را وارد نمایید'
			];
		}

        if(!$this->checkSendedCode($this->data['code'], $this->data['phone'])){
			$this->messages[] = [
				'input' => 'code',
				'status' => 'invalid',
				'message' => 'کد تایید اشتباه است لطفا مجددا اقدام نمایید'
			];
		}

        if(in_array('invalid', array_column($this->messages, 'status'))){
			return response()->json([
                'messages' => $this->messages,
                'user_register_status' => $this->user_register_status,
                'status' =>  504
            ]);
		}

      
    
        $user = $this->checkUserByPhone();
        if($user){
            Auth::login($user, true);
        }else{
            $user = $this->registerUser($this->data);
        }
        
        $redirect = false;
        if(isset($this->data['redirect-to-after-auth']) && $this->data['redirect-to-after-auth']){ $redirect = $this->data['redirect-to-after-auth']; }

        if ( Auth::check() ) {

			return response()->json([
				'redirect_to' => $redirect,
				'status' => 200,
				'messages' => [
					[
						'input' => 'code',
						'status' => 'valid',
						'message' => 'شما با موفقیت وارد حساب کاربری خود شدید'
					]
				],
				'alert' => [
					'status' => 'valid',
					'message' => 'شما با موفقیت وارد حساب کاربری خود شدید'
				],
				'user' => $user
			]);

            $endpoint = '/users';
            $data = makeApiRequest('post', $endpoint, $user);
            session()->put('authToken', data_get($data, 'extra.authToken'));


		}

        $this->messages[] = [
			'input' => 'name',
			'status' => 'invalid',
			'message' => 'ورود ناموفق، لطفا دوباره تلاش کنید'
		];

        return response()->json([
            'messages' => $this->messages,
            'user_register_status' => $this->user_register_status,
            'status' =>  502
        ]);
      
}
  


  	public function registerUser($data){
    
      	$user = new User();
      	$user->name = $data['name'];
      	$user->phone = $data['phone'];
        $user->country_code = config('country.code');
        $user->language_code = config('app.locale');
        $user->phone_token = $data['phone'];
        $user->accept_terms = 1;
        $user->accept_marketing_offers = 1;
      	$user->save();
      
      	Auth::login($user, true);
		return $user;
    }
  
  
  	
}
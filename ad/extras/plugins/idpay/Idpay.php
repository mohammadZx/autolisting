<?php

namespace extras\plugins\Idpay;

use App\Helpers\Number;
use App\Models\Post;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use App\Helpers\Payment;
use App\Models\Package;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class Idpay extends Payment
{
	/**
	 * Send Payment
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param \App\Models\Post $post
	 * @param array $resData
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 * @throws \Exception
	 */
	public static function sendPayment(Request $request, Post $post, array $resData = [])
	{
		// Set the right URLs
		parent::setRightUrls($resData);
		
		// Get the Package
		$package = Package::find($request->input('package_id'));
		
		// Don't make a payment if 'price' = 0 or null
		if (empty($package) || $package->price <= 0) {
			return redirect(parent::$uri['previousUrl'] . '?error=package')->withInput();
		}
		
		// Get the amount
		$amount = Number::toFloat($package->price);
		
		// API Parameters
		$localParams  = [
			'order_id' => md5($post->id . $package->id . uniqid('', true)), // Unique value,
			'amount' => $amount,
			'name' => config('app.name'),
			'desc' => Str::limit($package->name, 122),
			'callback' => parent::$uri['paymentReturnUrl'], // parent::$uri['paymentCancelUrl']

			// local params
			'payment_method_id' => $request->input('payment_method_id'),
			'post_id'           => $post->id,
			'package_id'        => $package->id,
		];

		
		
		// Try to make the Payment
		try {

	
			$response = Http::withHeaders([
				'Content-Type' => 'application/json',
				'X-API-KEY' => config('payment.idpay.apikey'),
				'X-SANDBOX' => config('payment.idpay.sandbox'),
			])->post( config('payment.idpay.payment') , $localParams);
	
			
			// Payment by Credit Card when Card info are provided from the form.
			if ($response->successful() && isset($response->json()['link'])) {
				
				// Save the Transaction ID at the Provider
				//$localParams['transaction_id'];
			
				// Save local parameters into session
				session()->put('params', $localParams);
				session()->save(); // If redirection to an external URL will be done using PHP header() function

				
				redirectUrl($response->json()['link']);
		
				
				// Apply actions when Payment failed
				return parent::paymentFailureActions($post, 'خطا هنگام ارسال به بانک');
				
			} else {
		
				// Apply actions when Payment failed
				return parent::paymentFailureActions($post, 'خطای بانکی');
				
			}
		} catch (\Throwable $e) {
			
			// Apply actions when API failed
			return parent::paymentApiErrorActions($post, $e);
			
		}
	}
	
	/**
	 * @param $params
	 * @param $post
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 * @throws \Exception
	 */
	public static function paymentConfirmation($params, $post)
	{

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$response = $_POST;
		  }
  
		  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
			$response = $_GET;
		  }
  
		  if (empty($response['status']) ||
			  empty($response['id']) ||
			  empty($response['track_id']) ||
			  empty($response['order_id'])) {
				return parent::paymentFailureActions($post, 'Error whene comeback gateway.');
		  }


		// Set form page URL
		parent::$uri['previousUrl'] = str_replace(['#entryToken', '#entryId'], [$post->tmp_token, $post->id], parent::$uri['previousUrl']);
		parent::$uri['nextUrl'] = str_replace(['#entryToken', '#entryId', '#entrySlug'], [$post->tmp_token, $post->id, $post->slug], parent::$uri['nextUrl']);
		
		// Get Charge ID
		$approvedOrderId = $params['transaction_id'] ?? null;

		// Try to make the Payment
		try {

			$inquiry = self::idpay_payment_get_inquiry($response);
        	$verify = self::idpay_payment_verify($response);
		    


			// Check the Payment
			if ($verify->successful()) {
				
				// Save the Transaction ID at the Provider
				$params['transaction_id'] = $verify->json()['track_id'];
				
				// Apply actions after successful Payment
				return parent::paymentConfirmationActions($params, $post);
				
			} else {
				
				// Apply actions when Payment failed
				return parent::paymentFailureActions($post);
				
			}
		} catch (\Throwable $e) {
			
			// Apply actions when API failed
			return parent::paymentApiErrorActions($post, $e);
			
		}
	}



	public static function idpay_payment_get_inquiry($response) {


		$response = Http::withHeaders([
			'Content-Type' => 'application/json',
			'X-API-KEY' => config('payment.idpay.apikey'),
			'X-SANDBOX' => config('payment.idpay.sandbox'),
		])->post( config('payment.idpay.inquiry') , [
			'id' => $response['id'],
		  	'order_id' => $response['order_id'],
		]);

		if ($response->successful() && isset($response->json()['status']) && $response->json()['status']){
			return TRUE;
		}

		return FALSE;
}
  
  
	  /**
	   * @param array $response
	   * @return bool
	   */
	public static function idpay_payment_verify($response) {

		$response = Http::withHeaders([
			'Content-Type' => 'application/json',
			'X-API-KEY' => config('payment.idpay.apikey'),
			'X-SANDBOX' => config('payment.idpay.sandbox'),
		])->post( config('payment.idpay.verify') , [
			'id' => $response['id'],
		  	'order_id' => $response['order_id'],
		]);

  
	   return $response;
}

	  

	
	/**
	 * @return array
	 */
	public static function getOptions(): array
	{
		$options = [];
		
		$paymentMethod = PaymentMethod::active()->where('name', 'idpay')->first();
		if (!empty($paymentMethod)) {
			$options[] = (object)[
				'name'     => mb_ucfirst(trans('admin.settings')),
				'url'      => admin_url('payment_methods/' . $paymentMethod->id . '/edit'),
				'btnClass' => 'btn-info',
			];
		}
		
		return $options;
	}
	
	/**
	 * @return bool
	 */
	public static function installed(): bool
	{
		$paymentMethod = PaymentMethod::active()->where('name', 'idpay')->first();
		if (empty($paymentMethod)) {
			return false;
		}
		
		return true;
	}
	
	/**
	 * @return bool
	 */
	public static function install(): bool
	{
		// Remove the plugin entry
		self::uninstall();
		
		// Plugin data
		$data = [
			'id'                => 2,
			'name'              => 'idpay',
			'display_name'      => 'آیدی پی',
			'description'       => 'پرداخت امن با آیدی پی',
			'has_ccbox'         => 0,
			'is_compatible_api' => 0,
			'countries'         => null,
			'lft'               => 0,
			'rgt'               => 0,
			'depth'             => 1,
			'active'            => 1,
		];
		
		try {
			// Create plugin data
			$paymentMethod = PaymentMethod::create($data);
			if (empty($paymentMethod)) {
				return false;
			}
		} catch (\Throwable $e) {
			return false;
		}
		
		return true;
	}
	
	/**
	 * @return bool
	 */
	public static function uninstall(): bool
	{
		$paymentMethod = PaymentMethod::where('name', 'idpay')->first();
		if (!empty($paymentMethod)) {
			$deleted = $paymentMethod->delete();
			if ($deleted > 0) {
				return true;
			}
		}
		
		return false;
	}
}

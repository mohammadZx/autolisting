<?php

namespace App\Options\Sms\Melipayamak;

use App\Options\Sms\SmsDriverInterface;
use Illuminate\Support\Facades\Http;

class Melipayamak implements SmsDriverInterface{
    public $username;
    public $password;
    public $from;
    public const PATH = "https://rest.payamak-panel.com/api/SendSMS/";
    public function __construct()
    {
        $this->username = env('MELIPAYAMAK_USERNAME');
        $this->password = env('MELIPAYAMAK_PASSWORD');
        $this->from = env('MELIPAYAMAK_LINE');
    }
    public function sendByBodyId($to, $bodyId, $data){
        return $this->execute([
            'to' => $to,
            'bodyId' => $bodyId,
            'text' => $data,
            'path' => self::PATH . 'BaseServiceNumber'
        ]);
    }

    public function send($to,$data,...$args)
	{
		
		return $this->execute([
            'to' => $to,
            'text' => $data,
            'IsFlash' => false,
            'path' => self::PATH . 'SendSMS'
        ]);
		
	}

    public function execute($data){
        $data['username'] = $this->username;
        $data['password'] = $this->password;
        $data['from'] = $this->from;
        
        $res = Http::post($data['path'], $data);
        if($res->successful()){
           return $res->body();
          }else{
            return $res->status();
          }
    }
}
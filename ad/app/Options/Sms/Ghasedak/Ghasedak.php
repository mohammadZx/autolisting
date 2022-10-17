<?php

namespace App\Options\Sms\Ghasedak;

use App\Options\Sms\SmsDriverInterface;
use Illuminate\Support\Facades\Http;

class Ghasedak implements SmsDriverInterface{
    public $apikey;
    public $line;
    public const PATH = "http://api.ghasedak.me/v2/";
    public function __construct()
    {
        $this->apikey = env('GHASEDAKAPI_KEY');
        $this->line = env('GHASEDAKAPI_LINE');
    }
    public function sendByBodyId($to, $bodyId, $data)
    {
         //
        $data = explode(';', $data);
        $ex = [
            "receptor" => $to,
            "type" => 1,
            "template" => $bodyId, 
        ];

        foreach($data as $key => $item){
            $ex["param" . ($key + 1)] = $item;
        }

         $this->execute($ex, self::PATH . 'verification/send/simple?agent=php');
         
    }

    public function send($to, $data, ...$args)
    {

        $this->execute([
            "receptor" => $to,
            "linenumber" => $this->line,
            "message" => $data,
            "senddate" => null,
            "checkid" => null
        ], self::PATH . 'sms/send/simple?agent=php');
    }


    public function execute($data, $path){

        $invalidMessage = [
            'message' => [
                'type' => 'invalid',
                'message' => 'پیامک ارسال نشده لطفا دوباره اقدام کنید'
            ]
            ];

        $response = Http::asForm()->withHeaders([
            'apikey' => $this->apikey,
            'Accept' => 'application/json',
            'Content-Type' => 'application/x-www-form-urlencoded',
            'charset' => 'utf-8',
        ])->post($path, $data);

        
        if(!$response->successful()) return response()->json($invalidMessage);
        
        if (is_null($response->json())) {
            return response()->json($invalidMessage);
        } else {

            $return = $response->json();
            if ($return['result']['code'] != 200) {
                return response()->json($invalidMessage);
            }
            return response()->json($response->json());
        }
        return response()->json($invalidMessage);
    }
}
<?php
namespace App\Options\Sms;
interface SmsDriverInterface{
    public function sendByBodyId($to, $bodyId, $data);
    public function send($to,$data,...$args);
}
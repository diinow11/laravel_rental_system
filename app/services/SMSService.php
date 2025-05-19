<?php

namespace App\Services;

use AfricasTalking\SDK\AfricasTalking;

class SMSService
{
    protected $sms;

    public function __construct()
    {
        $username = env('AFRICASTALKING_USERNAME');
        $apiKey = env('AFRICASTALKING_API_KEY');

        $at = new AfricasTalking($username, $apiKey);
        $this->sms = $at->sms();
    }

    public function send($to, $message)
    {
        return $this->sms->send([
            'to'      => $to,
            'message' => $message
        ]);
    }
}

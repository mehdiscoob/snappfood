<?php

namespace App\Services\sms;

interface SMSStrategy
{
    public function sendSms($to, $message);
}

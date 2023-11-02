<?php

namespace App\Services\SMS;

class SMSContext
{
    protected $strategy;

    public function setStrategy(SMSStrategy $strategy)
    {
        $this->strategy = $strategy;
    }

    public function sendSms($to, $message)
    {
        // Use the selected strategy to send the SMS
        return $this->strategy->sendSms($to, $message);
    }
}

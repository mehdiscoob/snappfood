<?php

// app/Services/SMS/VerificationSmsStrategy.php

namespace App\Services\sms;

class VerificationSmsStrategy implements SMSStrategy
{
    public function sendSms($to, $verificationCode)
    {
        $apiUrl = 'https://your-sms-gateway-api.com/send-sms';
        $apiKey = 'your-api-key';

        $message = "Your verification code: $verificationCode";

        $data = [
            'to' => $to,
            'message' => $message,
            'apiKey' => $apiKey,
        ];

        $httpClient = new \GuzzleHttp\Client();
        $response = $httpClient->post($apiUrl, [
            'json' => $data,
        ]);

        if ($response->getStatusCode() === 200) {
            return true;
        } else {
            return false;
        }
    }
}

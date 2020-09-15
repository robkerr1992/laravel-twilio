<?php

namespace Rksugarfree\Twilio;

use Rksugarfree\Twilio\Interfaces\CallResponse;
use Rksugarfree\Twilio\Interfaces\MessageResponse;
use Twilio\Rest\Api;
use Twilio\Rest\Api\V2010;
use Twilio\Rest\Api\V2010\Account\CallInstance;
use Twilio\Rest\Api\V2010\Account\MessageInstance;
use Twilio\Rest\Client;

class TwilioClientFake extends TwilioClient
{
    public function __construct()
    {
        $this->sid = 'nonsense';
        $this->token = 'nonsense';
        $this->from = '+12223334444';
        $this->sslVerify = false;
    }

    public function call(string $to, $message, array $params = []): CallResponse
    {
        $call = new CallInstance($this->v2010ApiClient(), [
            'to' => $to,
            'from' => $params['from'] ?? $this->from,
        ], $this->sid);

        return new TwilioCallResponse($call);
    }

    public function message(string $to, string $message, array $mediaUrls = [], array $params = []): MessageResponse
    {
        $message = new MessageInstance($this->v2010ApiClient(), [
            'to' => $to,
            'from' => $params['from'] ?? $this->from,
        ], $this->sid);

        return new TwilioSmsResponse($message);
    }

    public function getClient(): Client
    {
        return new Client('nonsense', 'nonsense');
    }

    private function v2010ApiClient(): V2010
    {
        return new V2010(
            new Api($this->getClient())
        );
    }
}

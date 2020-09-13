<?php

namespace Rksugarfree\Twilio;

use Rksugarfree\Twilio\Interfaces\CallResponse;
use Rksugarfree\Twilio\Interfaces\MessageResponse;
use Rksugarfree\Twilio\Interfaces\CommunicationsClient;
use Rksugarfree\Twilio\Interfaces\Sms;
use Twilio\Rest\Api;
use Twilio\Rest\Api\V2010;
use Twilio\Rest\Api\V2010\Account\CallInstance;
use Twilio\Rest\Api\V2010\Account\MessageInstance;
use Twilio\Rest\Client;

class TwilioFake implements CommunicationsClient
{
    public function call(string $to, $message, array $params = []): CallResponse
    {
        return new TwilioCallResponse(
            new CallInstance($this->v2010ApiClient(), [], '')
        );
    }

    public function message(string $to, string $message, array $mediaUrls = [], array $params = []): MessageResponse
    {
        return new TwilioSmsResponse(
            new MessageInstance($this->v2010ApiClient(), [], '')
        );
    }

    private function v2010ApiClient(): V2010
    {
        $dummyClient = new Client('nonsense', 'nonsense');

        return new V2010(
            new Api($dummyClient)
        );
    }
}

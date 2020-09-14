<?php

namespace Rksugarfree\Twilio;

use Twilio\Rest\Api;
use Twilio\Rest\Api\V2010;
use Twilio\Rest\Api\V2010\Account\CallInstance;
use Twilio\Rest\Api\V2010\Account\MessageInstance;
use Twilio\Rest\Client;

class TwilioFake extends Twilio
{
    public function call(string $to, $message, array $params = []): CallInstance
    {
        return new CallInstance($this->v2010ApiClient(), [
            'to' => $to,
            'from' => $params['from'] ?? $this->from,
        ], $this->sid);
    }

    public function message(string $to, string $message, array $mediaUrls = [], array $params = []): MessageInstance
    {
        return new MessageInstance($this->v2010ApiClient(), [
            'to' => $to,
            'from' => $params['from'] ?? $this->from,
        ], $this->sid);
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

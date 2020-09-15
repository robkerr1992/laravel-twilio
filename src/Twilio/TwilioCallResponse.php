<?php

namespace Rksugarfree\MessageManager\Twilio;

use Rksugarfree\MessageManager\Interfaces\CallResponse;
use Twilio\Rest\Api\V2010\Account\CallInstance;

class TwilioCallResponse implements CallResponse
{
    /* @var CallInstance */
    private $call;

    public function __construct(CallInstance $call)
    {
        $this->call = $call;
    }

    public function get()
    {
        return $this->call;
    }
}
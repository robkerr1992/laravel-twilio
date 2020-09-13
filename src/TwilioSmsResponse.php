<?php

namespace Rksugarfree\Twilio;

use Rksugarfree\Twilio\Interfaces\MessageResponse;
use Twilio\Rest\Api\V2010\Account\MessageInstance;

class TwilioSmsResponse implements MessageResponse
{
    /* @var MessageInstance */
    private $sms;

    public function __construct(MessageInstance $sms)
    {
        $this->sms = $sms;
    }

    public function get()
    {
        return $this->sms;
    }
}
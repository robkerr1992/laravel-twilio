<?php

namespace Rksugarfree\Twilio\Tests\Feature;

use PHPUnit\Framework\TestCase;
use Rksugarfree\Twilio\TwilioClient;
use Rksugarfree\Twilio\TwilioCallResponse;
use Rksugarfree\Twilio\TwilioClientFake;
use Rksugarfree\Twilio\TwilioSmsResponse;
use Twilio\Rest\Api\V2010\Account\CallInstance;
use Twilio\Rest\Api\V2010\Account\MessageInstance;
use Twilio\Rest\Client;

class TwilioTest extends TestCase
{
    /** @test */
    public function it_can_initialize()
    {
        $manager = $this->getTwilio();

        $this->assertTrue($manager instanceof TwilioClient);
    }

    /** @test */
    public function it_can_access_the_twilio_rest_client()
    {
        $client = $this->getTwilio()->getClient();

        $this->assertTrue($client instanceof Client);
    }

    /** @test */
    public function it_can_make_calls()
    {
        $twilio = new TwilioClientFake();
        $message = $twilio->call('+12224445555', 'Imma message', ['from' => '+15554443333']);

        $this->assertTrue($message instanceof TwilioCallResponse);
        $this->assertTrue($message->get() instanceof CallInstance);
    }


    /** @test */
    public function it_can_make_messages()
    {
        $twilio = new TwilioClientFake();
        $message = $twilio->message('+12224445555', 'Imma message', [], ['from' => '+15554443333']);

        $this->assertTrue($message instanceof TwilioSmsResponse);
        $this->assertTrue($message->get() instanceof MessageInstance);
    }

    private function getTwilio(): TwilioClient
    {
        return new TwilioClient('fake_sid', 'fake_token','+12223334444');
    }
}
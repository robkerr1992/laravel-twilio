<?php

namespace Rksugarfree\Twilio\Tests\Feature;

use PHPUnit\Framework\TestCase;
use Rksugarfree\Twilio\Twilio;
use Rksugarfree\Twilio\TwilioManager;

class TwilioManagerFacadeTest extends TestCase
{
    /** @test */
    public function it_gives_access_to_default_connection()
    {
        $manager = new TwilioManager('twilio', ['twilio' => [
            'sid' => 'fake_sid',
            'token' => 'fake_token',
            'from' => '222-222-2222',
        ]]);

        $this->assertTrue($manager->defaultConnection() instanceof Twilio);
    }

    /** @test */
    public function it_gives_access_to_other_connections()
    {
        $manager = new TwilioManager('twilio', ['other-connection' => [
            'sid' => 'fake_sid',
            'token' => 'fake_token',
            'from' => '222-222-2222',
        ]]);

        $this->assertTrue($manager->from('other-connection') instanceof Twilio);
    }
}
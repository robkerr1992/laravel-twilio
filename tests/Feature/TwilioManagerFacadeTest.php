<?php

namespace Rksugarfree\MessageManager\Tests\Feature;

use PHPUnit\Framework\TestCase;
use Rksugarfree\MessageManager\Interfaces\ClientManager;
use Rksugarfree\MessageManager\Interfaces\CommunicationsClient;
use Rksugarfree\MessageManager\Twilio\TwilioClient;
use Rksugarfree\MessageManager\Twilio\TwilioManager;

class TwilioManagerFacadeTest extends TestCase
{
    /** @test */
    public function it_can_initialize()
    {
        $manager = new TwilioManager(['twilio' => [
            'sid' => 'fake_sid',
            'token' => 'fake_token',
            'from' => '+12223334444',
        ]], 'twilio');

        $this->assertTrue($manager instanceof TwilioManager);
        $this->assertTrue($manager instanceof ClientManager);
    }

    /** @test */
    public function it_gives_access_to_default_connection()
    {
        $manager = new TwilioManager(['twilio' => [
            'sid' => 'fake_sid',
            'token' => 'fake_token',
            'from' => '+12223334444',
        ]], 'twilio');

        $this->assertTrue($manager->defaultConnection() instanceof TwilioClient);
        $this->assertTrue($manager->defaultConnection() instanceof CommunicationsClient);
    }

    /** @test */
    public function it_gives_access_to_other_connections()
    {
        $manager = new TwilioManager(['other-connection' => [
            'sid' => 'fake_sid',
            'token' => 'fake_token',
            'from' => '+12223334444',
        ]], 'twilio');

        $this->assertTrue($manager->from('other-connection') instanceof TwilioClient);
        $this->assertTrue($manager->from('other-connection') instanceof CommunicationsClient);
    }

    /** @test */
    public function it_throws_an_invalid_argument_exception_when_configuration_is_empty()
    {
        $this->expectException(\InvalidArgumentException::class);

        new TwilioManager([], 'twilio');
    }

    /** @test */
    public function it_throws_an_invalid_argument_exception_when_accessing_configuration_that_doesnt_exist()
    {
        $this->expectException(\InvalidArgumentException::class);

        $manager = new TwilioManager(['twilio' => [
            'sid' => 'fake_sid',
            'token' => 'fake_token',
            'from' => '+12223334444',
        ]], 'twilio');

        $manager->from('doesnt-exist');
    }
}
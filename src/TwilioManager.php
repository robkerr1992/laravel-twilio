<?php

namespace Rksugarfree\Twilio;

use Rksugarfree\Twilio\Interfaces\ClientManager;
use Rksugarfree\Twilio\Interfaces\CommunicationsClient;
use InvalidArgumentException;

class TwilioManager implements ClientManager
{
    /* @var string */
    private $default;

    /* @var array */
    private $configuration;

    public function __construct(array $configuration, string $default = 'twilio')
    {
        if(empty($configuration)) {
            throw new InvalidArgumentException("TwilioManager settings cannot be empty.");
        }

        $this->configuration = $configuration;
        $this->default = $default;
    }

    public function from(string $connection): CommunicationsClient
    {
        if (empty($this->configuration[$connection])) {
            throw new InvalidArgumentException("Connection \"{$connection}\" is not configured.");
        }

        $settings = $this->configuration[$connection];

        return new Twilio($settings['sid'], $settings['token'], $settings['from']);
    }

    public function defaultConnection(): CommunicationsClient
    {
        return $this->from($this->default);
    }
}

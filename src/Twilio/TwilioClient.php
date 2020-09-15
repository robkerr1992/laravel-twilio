<?php

namespace Rksugarfree\MessageManager\Twilio;

use Rksugarfree\MessageManager\Interfaces\CallResponse;
use Rksugarfree\MessageManager\Interfaces\MessageResponse;
use Rksugarfree\MessageManager\Interfaces\CommunicationsClient;
use Twilio\Rest\Client;
use Twilio\TwiML\TwiML;
use Twilio\TwiML\VoiceResponse;

class TwilioClient implements CommunicationsClient
{
    /* @var string */
    protected $sid;

    /* @var string */
    protected $token;

    /* @var string */
    protected $from;

    /* @var bool */
    protected $sslVerify;

    /* @var Client */
    protected $client;

    public function __construct(
        string $sid,
        string $token,
        string $from,
        bool $sslVerify = true
    )
    {
        $this->sid = $sid;
        $this->token = $token;
        $this->from = $from;
        $this->sslVerify = $sslVerify;
    }

    /* https://www.twilio.com/docs/api/messaging/send-messages Documentation */
    public function message(
        string $to,
        string $message,
        array $mediaUrls = [],
        array $params = []
    ): MessageResponse
    {
        $params['body'] = $message;

        if (empty($params['from'])) {
            $params['from'] = $this->from;
        }

        if (!empty($mediaUrls)) {
            $params['mediaUrl'] = $mediaUrls;
        }

        return new TwilioSmsResponse(
            $this->getClient()->messages->create($to, $params)
        );
    }

    /*
     * @param callable|string|TwiML $message
     * @see https://www.twilio.com/docs/api/voice/making-calls Documentation
     */
    public function call(string $to, $message, array $params = []): CallResponse
    {
        if (is_callable($message)) {
            $message = $this->twiml($message);
        }

        if ($message instanceof TwiML) {
            $params['twiml'] = (string) $message;
        } else {
            $params['url'] = $message;
        }

        $from = $params['from'] ?? $this->from;

        return new TwilioCallResponse(
            $this->getClient()->calls->create($to, $from, $params)
        );
    }

    public function getClient(): Client
    {
        if ($this->client) {
            return $this->client;
        }

        return $this->client = new Client($this->sid, $this->token);
    }

    private function twiml(callable $callback): TwiML
    {
        $message = new VoiceResponse();

        call_user_func($callback, $message);

        return $message;
    }
}

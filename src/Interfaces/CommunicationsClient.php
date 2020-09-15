<?php

namespace Rksugarfree\MessageManager\Interfaces;

interface CommunicationsClient
{
    public function call(string $to, $message, array $params): CallResponse;

    public function message(string $to, string $message, array $mediaUrls = [], array $params = []): MessageResponse;
}

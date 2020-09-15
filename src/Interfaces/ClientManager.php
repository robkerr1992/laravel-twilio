<?php

namespace Rksugarfree\MessageManager\Interfaces;

interface ClientManager
{
    public function from(string $connection): CommunicationsClient;

    public function defaultConnection(): CommunicationsClient;
}

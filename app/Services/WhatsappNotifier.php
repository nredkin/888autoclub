<?php

namespace App\Services;


use App\Messages\Message;
use App\Services\Clients\WhatsappClient;

class WhatsappNotifier implements Notifier
{
    private WhatsappClient $client;

    public function __construct(WhatsappClient $client)
    {
        $this->client = $client;
    }

    public function notify(string $address, Message $message)
    {
//        $this->client->notify($address, $message);
    }

    public function notifyWithBranchProfileId(string $address, string $profileId, Message $message): void
    {
        $this->client->notifyWithBranchProfileId($address, $profileId, $message);
    }

    public function sendFile(string $address, string $caption, string $filename, string $content)
    {
//        $this->client->sendFile($address, $caption, $filename, $content);
    }
}

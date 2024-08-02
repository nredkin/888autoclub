<?php

namespace App\Services\Clients;

use App\Messages\Message;

interface WhatsappClient
{
    public function notify(string $address, Message $message);

    public function notifyWithBranchProfileId(string $address, string $profileId, Message $message);

    public function sendFile(string $address, string $caption, string $filename, string $content);
}

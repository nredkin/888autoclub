<?php

namespace App\Services\Clients;


use App\Messages\Message;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class WappiProClient implements WhatsappClient
{
    private const API_URL_SEND_MESSSAGE = 'https://wappi.pro/api/sync/message/send?profile_id=%s';
    private const API_URL_SEND_FILE = 'https://wappi.pro/api/sync/message/document/send?profile_id=%s';

    private Client $http;

    private string $profileId;
    private string $token;

    public function __construct(Client $http, string $profileId, string $token)
    {
        $this->http = $http;

        $this->profileId = $profileId;
        $this->token = $token;
    }

    public function notify(string $address, Message $message)
    {
        try {
            $this->http->post(sprintf(self::API_URL_SEND_MESSSAGE, $this->profileId), [
                RequestOptions::HEADERS => [
                    'Authorization' => $this->token
                ],
                RequestOptions::JSON    => [
                    'body'      => $message->buildMessage(),
                    'recipient' => $address
                ],
            ]);
        } catch(\Exception $e) {
            \Log::error($e->getMessage());
        }
    }

    public function notifyWithBranchProfileId(string $address, string $profileId, Message $message): void
    {
        try {
            $this->http->post(sprintf(self::API_URL_SEND_MESSSAGE, $profileId), [
                RequestOptions::HEADERS => [
                    'Authorization' => $this->token
                ],
                RequestOptions::JSON    => [
                    'body'      => $message->buildMessage(),
                    'recipient' => $address
                ],
            ]);
        } catch(\Exception $e) {
            \Log::error($e->getMessage());
        }
    }

    public function sendFile(string $address, string $caption, string $filename, string $content)
    {
        try {
            $this->http->post(sprintf(self::API_URL_SEND_FILE, $this->profileId), [
                RequestOptions::HEADERS => [
                    'Authorization' => $this->token
                ],
                RequestOptions::JSON    => [
                    'caption'   => $caption,
                    'file_name' => $filename,
                    'b64_file'  => $content,
                    'recipient' => $address
                ],
            ]);
        } catch(\Exception $e) {
            \Log::error($e->getMessage());
        }
    }
}

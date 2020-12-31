<?php
declare(strict_types=1);

namespace InstaFetcher\DataAccess\Http\SymfonyHttp;


abstract class FacebookGraphSymfonyHttpDao
{
    protected int $appId;
    protected string $appSecret;
    protected string $baseUrl;

    public function __construct(int $appId, string $appSecret, string $baseUrl)
    {
        $this->appId = $appId;
        $this->appSecret = $appSecret;
        $this->baseUrl = $baseUrl;
    }

    protected function generateAppSecretProof(string $token): string{
        return hash_hmac('sha256', $token, $this->appSecret);
    }
}
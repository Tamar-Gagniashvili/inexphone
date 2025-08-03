<?php

namespace Caravan\InexPhoneSms\Http;

use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;

class InexPhoneSmsConnector extends Connector
{
    use AcceptsJson;
    use AlwaysThrowOnErrors;

    protected string $apiToken;

    public function __construct(
        protected string $baseUrl,
        string $token,
        protected int $timeout = 30,
        protected int $retryAttempts = 3,
        protected int $retryDelay = 1000
    ) {
        $this->apiToken = $token;
    }

    public function resolveBaseUrl(): string
    {
        return $this->baseUrl;
    }

    protected function defaultHeaders(): array
    {
        return [
            'Authorization' => 'Bearer ' . $this->apiToken,
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];
    }

    protected function defaultConfig(): array
    {
        return [
            'timeout' => $this->timeout,
        ];
    }
}


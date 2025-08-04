<?php

namespace Caravan\InexPhoneSms\Http\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class VerifyOtpRequest extends Request
{
    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/otp/verify';
    }

    public function __construct(
        public string $phone,
        public string $code,
    ) {}

    protected function defaultBody(): array
    {
        return [
            'phone' => $this->phone,
            'code' => $this->code,
        ];
    }
}

<?php

namespace Caravan\InexPhoneSms\Http\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class SendCommercialSmsRequest extends Request
{
    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/sms/commercial';
    }

    public function __construct(
        public string $phone,
        public string $subject,
        public string $message,
    ) {}

    protected function defaultBody(): array
    {
        return [
            'phone' => $this->phone,
            'subject' => $this->subject,
            'message' => $this->message,
        ];
    }
}


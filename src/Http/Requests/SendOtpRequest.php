<?php

namespace Caravan\InexPhoneSms\Http\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class SendOtpRequest extends Request
{
    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/otp/send';
    }

    public function __construct(
        public string $phone,
        public string $subject,
        public ?string $text = null,
        public ?int $expiresIn = null,
    ) {}

    protected function defaultBody(): array
    {
        $body = [
            'phone' => $this->phone,
            'subject' => $this->subject,
        ];

        if ($this->text !== null) {
            $body['text'] = $this->text;
        }

        if ($this->expiresIn !== null) {
            $body['expiresIn'] = $this->expiresIn;
        }

        return $body;
    }
}

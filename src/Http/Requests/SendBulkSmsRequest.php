<?php

namespace Caravan\InexPhoneSms\Http\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class SendBulkSmsRequest extends Request
{
    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/sms/bulk';
    }

    public function __construct(
        public string $subject,
        public string $message,
        public array $phoneNumbers,
        public ?string $submitCallbackUrl = null,
        public ?string $deliveryCallbackUrl = null,
    ) {}

    protected function defaultBody(): array
    {
        $body = [
            'subject' => $this->subject,
            'message' => $this->message,
            'phone_numbers' => $this->phoneNumbers,
        ];

        if ($this->submitCallbackUrl !== null) {
            $body['submit_callback_url'] = $this->submitCallbackUrl;
        }

        if ($this->deliveryCallbackUrl !== null) {
            $body['delivery_callback_url'] = $this->deliveryCallbackUrl;
        }

        return $body;
    }
}


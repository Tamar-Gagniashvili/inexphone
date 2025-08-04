<?php

namespace Caravan\InexPhoneSms\Http\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class SendSmsRequest extends Request
{
    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/sms/one';
    }

    public function __construct(
        public string $phone,
        public string $subject,
        public string $message,
        public ?bool $ignoreBlacklist = null,
        public ?string $submitCallbackUrl = null,
        public ?string $deliveryCallbackUrl = null,
    ) {}

    protected function defaultBody(): array
    {
        $body = [
            'phone' => $this->phone,
            'subject' => $this->subject,
            'message' => $this->message,
        ];

        if ($this->ignoreBlacklist !== null) {
            $body['ignore_blacklist'] = $this->ignoreBlacklist;
        }

        if ($this->submitCallbackUrl !== null) {
            $body['submit_callback_url'] = $this->submitCallbackUrl;
        }

        if ($this->deliveryCallbackUrl !== null) {
            $body['delivery_callback_url'] = $this->deliveryCallbackUrl;
        }

        return $body;
    }
}

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

class GetSmsListRequest extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/sms';
    }

    public function __construct(
        public ?int $page = null,
        public ?int $perPage = null,
        public ?string $sort = null,
        public ?string $subject = null,
        public ?string $dateStart = null,
        public ?string $dateEnd = null,
    ) {}

    protected function defaultQuery(): array
    {
        $query = [];

        if ($this->page !== null) {
            $query['page'] = $this->page;
        }

        if ($this->perPage !== null) {
            $query['perPage'] = $this->perPage;
        }

        if ($this->sort !== null) {
            $query['sort'] = $this->sort;
        }

        if ($this->subject !== null) {
            $query['filters[subject]'] = $this->subject;
        }

        if ($this->dateStart !== null) {
            $query['filters[dateStart]'] = $this->dateStart;
        }

        if ($this->dateEnd !== null) {
            $query['filters[dateEnd]'] = $this->dateEnd;
        }

        return $query;
    }
}

class GetSmsRequest extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/sms/' . $this->uuid;
    }

    public function __construct(
        public string $uuid,
    ) {}
}

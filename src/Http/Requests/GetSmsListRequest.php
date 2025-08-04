<?php

namespace Caravan\InexPhoneSms\Http\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

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


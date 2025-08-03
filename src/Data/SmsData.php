<?php

namespace Caravan\InexPhoneSms\Data;

use Spatie\LaravelData\Data;

class SendSmsData extends Data
{
    public function __construct(
        public string $phone,
        public string $subject,
        public string $message,
        public ?bool $ignoreBlacklist = null,
        public ?string $submitCallbackUrl = null,
        public ?string $deliveryCallbackUrl = null,
    ) {}
}

class SendBulkSmsData extends Data
{
    public function __construct(
        public string $subject,
        public string $message,
        /** @var string[] */
        public array $phoneNumbers,
        public ?string $submitCallbackUrl = null,
        public ?string $deliveryCallbackUrl = null,
    ) {}
}

class SendCommercialSmsData extends Data
{
    public function __construct(
        public string $phone,
        public string $subject,
        public string $message,
    ) {}
}

class SmsResourceData extends Data
{
    public function __construct(
        public string $id,
        public string $type,
        public SmsAttributesData $attributes,
        public ?SmsRelationshipsData $relationships = null,
    ) {}
}

class SmsAttributesData extends Data
{
    public function __construct(
        public string $number,
        public string $subject,
        public string $message,
        public string $createdAt,
    ) {}
}

class SmsRelationshipsData extends Data
{
    public function __construct(
        public SmsReportsData $reports,
    ) {}
}

class SmsReportsData extends Data
{
    public function __construct(
        /** @var SmsReportResourceData[] */
        public array $data,
    ) {}
}

class SmsReportResourceData extends Data
{
    public function __construct(
        public string $id,
        public string $type,
        public SmsReportAttributesData $attributes,
    ) {}
}

class SmsReportAttributesData extends Data
{
    public function __construct(
        public string $actualProvider,
        public string $intendedProvider,
        public int $status,
        public string $type,
        public string $smscId,
        public int $part,
        public int $partsTotal,
        public string $receiver,
        public string $sender,
        public string $createdAt,
    ) {}
}

class SmsResponseData extends Data
{
    public function __construct(
        public string $message,
        /** @var SmsResourceData[] */
        public array $data,
    ) {}
}

class SmsListResponseData extends Data
{
    public function __construct(
        public string $message,
        /** @var SmsResourceData[] */
        public array $data,
        public MetaData $meta,
    ) {}
}

class MetaData extends Data
{
    public function __construct(
        public PaginationData $pagination,
    ) {}
}

class PaginationData extends Data
{
    public function __construct(
        public ?int $total,
        public ?int $count,
        public ?int $perPage,
        public ?int $currentPage,
        public ?int $totalPages,
        public LinksData $links,
    ) {}
}

class LinksData extends Data
{
    public function __construct(
        public ?string $next,
        public ?string $previous,
    ) {}
}

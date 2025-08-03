<?php

namespace Caravan\InexPhoneSms\Data;

use Spatie\LaravelData\Data;

class SendOtpData extends Data
{
    public function __construct(
        public string $phone,
        public string $subject,
        public ?string $text = null,
        public ?int $expiresIn = null,
    ) {}
}

class VerifyOtpData extends Data
{
    public function __construct(
        public string $phone,
        public string $code,
    ) {}
}

class OtpResourceData extends Data
{
    public function __construct(
        public string $id,
        public string $type,
        public OtpAttributesData $attributes,
    ) {}
}

class OtpAttributesData extends Data
{
    public function __construct(
        public string $phone,
        public string $subject,
        public string $createdAt,
        public string $expiresAt,
    ) {}
}

class OtpResponseData extends Data
{
    public function __construct(
        public string $message,
        /** @var OtpResourceData[] */
        public array $data,
    ) {}
}

class VerifyOtpResponseData extends Data
{
    public function __construct(
        public string $message,
    ) {}
}

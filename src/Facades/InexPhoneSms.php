<?php

namespace Caravan\InexPhoneSms\Facades;

use Caravan\InexPhoneSms\InexPhoneSmsClient;
use Illuminate\Support\Facades\Facade;

/**
 * @method static \Caravan\InexPhoneSms\Data\OtpResponseData sendOtp(string $phone, ?string $subject = null, ?string $text = null, ?int $expiresIn = null)
 * @method static \Caravan\InexPhoneSms\Data\VerifyOtpResponseData verifyOtp(string $phone, string $code)
 * @method static \Caravan\InexPhoneSms\Data\SmsResponseData sendSms(string $phone, string $message, ?string $subject = null, ?bool $ignoreBlacklist = null, ?string $submitCallbackUrl = null, ?string $deliveryCallbackUrl = null)
 * @method static \Caravan\InexPhoneSms\Data\SmsResponseData sendBulkSms(array $phoneNumbers, string $message, ?string $subject = null, ?string $submitCallbackUrl = null, ?string $deliveryCallbackUrl = null)
 * @method static \Caravan\InexPhoneSms\Data\SmsResponseData sendCommercialSms(string $phone, string $message, ?string $subject = null)
 * @method static \Caravan\InexPhoneSms\Data\SmsListResponseData getSms(?int $page = null, ?int $perPage = null, ?string $sort = null, ?string $subject = null, ?string $dateStart = null, ?string $dateEnd = null)
 * @method static \Caravan\InexPhoneSms\Data\SmsResponseData getSmsById(string $uuid)
 */
class InexPhoneSms extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return InexPhoneSmsClient::class;
    }
}

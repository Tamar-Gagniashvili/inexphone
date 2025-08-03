<?php

namespace Caravan\InexPhoneSms;

use Caravan\InexPhoneSms\Data\OtpResponseData;
use Caravan\InexPhoneSms\Data\SendOtpData;
use Caravan\InexPhoneSms\Data\SmsListResponseData;
use Caravan\InexPhoneSms\Data\SmsResponseData;
use Caravan\InexPhoneSms\Data\VerifyOtpData;
use Caravan\InexPhoneSms\Data\VerifyOtpResponseData;
use Caravan\InexPhoneSms\Http\InexPhoneSmsConnector;
use Caravan\InexPhoneSms\Http\Requests\GetSmsListRequest;
use Caravan\InexPhoneSms\Http\Requests\GetSmsRequest;
use Caravan\InexPhoneSms\Http\Requests\SendBulkSmsRequest;
use Caravan\InexPhoneSms\Http\Requests\SendCommercialSmsRequest;
use Caravan\InexPhoneSms\Http\Requests\SendOtpRequest;
use Caravan\InexPhoneSms\Http\Requests\SendSmsRequest;
use Caravan\InexPhoneSms\Http\Requests\VerifyOtpRequest;
use Saloon\Exceptions\Request\RequestException;

class InexPhoneSmsClient
{
    public function __construct(
        private InexPhoneSmsConnector $connector
    ) {}

    /**
     * Send OTP SMS
     */
    public function sendOtp(
        string $phone,
        ?string $subject = null,
        ?string $text = null,
        ?int $expiresIn = null
    ): OtpResponseData {
        $subject = $subject ?? config('inexphone-sms.default_subject');
        $text = $text ?? config('inexphone-sms.default_otp_text');
        $expiresIn = $expiresIn ?? config('inexphone-sms.default_otp_expires_in');

        $request = new SendOtpRequest($phone, $subject, $text, $expiresIn);
        
        try {
            $response = $this->connector->send($request);
            return OtpResponseData::from($response->json());
        } catch (RequestException $e) {
            throw new InexPhoneSmsException(
                'Failed to send OTP: ' . $e->getMessage(),
                $e->getCode(),
                $e
            );
        }
    }

    /**
     * Verify OTP code
     */
    public function verifyOtp(string $phone, string $code): VerifyOtpResponseData
    {
        $request = new VerifyOtpRequest($phone, $code);
        
        try {
            $response = $this->connector->send($request);
            return VerifyOtpResponseData::from($response->json());
        } catch (RequestException $e) {
            throw new InexPhoneSmsException(
                'Failed to verify OTP: ' . $e->getMessage(),
                $e->getCode(),
                $e
            );
        }
    }

    /**
     * Send single SMS
     */
    public function sendSms(
        string $phone,
        string $message,
        ?string $subject = null,
        ?bool $ignoreBlacklist = null,
        ?string $submitCallbackUrl = null,
        ?string $deliveryCallbackUrl = null
    ): SmsResponseData {
        $subject = $subject ?? config('inexphone-sms.default_subject');

        $request = new SendSmsRequest(
            $phone,
            $subject,
            $message,
            $ignoreBlacklist,
            $submitCallbackUrl,
            $deliveryCallbackUrl
        );
        
        try {
            $response = $this->connector->send($request);
            return SmsResponseData::from($response->json());
        } catch (RequestException $e) {
            throw new InexPhoneSmsException(
                'Failed to send SMS: ' . $e->getMessage(),
                $e->getCode(),
                $e
            );
        }
    }

    /**
     * Send bulk SMS
     */
    public function sendBulkSms(
        array $phoneNumbers,
        string $message,
        ?string $subject = null,
        ?string $submitCallbackUrl = null,
        ?string $deliveryCallbackUrl = null
    ): SmsResponseData {
        $subject = $subject ?? config('inexphone-sms.default_subject');

        $request = new SendBulkSmsRequest(
            $subject,
            $message,
            $phoneNumbers,
            $submitCallbackUrl,
            $deliveryCallbackUrl
        );
        
        try {
            $response = $this->connector->send($request);
            return SmsResponseData::from($response->json());
        } catch (RequestException $e) {
            throw new InexPhoneSmsException(
                'Failed to send bulk SMS: ' . $e->getMessage(),
                $e->getCode(),
                $e
            );
        }
    }

    /**
     * Send commercial SMS
     */
    public function sendCommercialSms(
        string $phone,
        string $message,
        ?string $subject = null
    ): SmsResponseData {
        $subject = $subject ?? config('inexphone-sms.default_subject');

        $request = new SendCommercialSmsRequest($phone, $subject, $message);
        
        try {
            $response = $this->connector->send($request);
            return SmsResponseData::from($response->json());
        } catch (RequestException $e) {
            throw new InexPhoneSmsException(
                'Failed to send commercial SMS: ' . $e->getMessage(),
                $e->getCode(),
                $e
            );
        }
    }

    /**
     * Get SMS list
     */
    public function getSms(
        ?int $page = null,
        ?int $perPage = null,
        ?string $sort = null,
        ?string $subject = null,
        ?string $dateStart = null,
        ?string $dateEnd = null
    ): SmsListResponseData {
        $request = new GetSmsListRequest(
            $page,
            $perPage,
            $sort,
            $subject,
            $dateStart,
            $dateEnd
        );
        
        try {
            $response = $this->connector->send($request);
            return SmsListResponseData::from($response->json());
        } catch (RequestException $e) {
            throw new InexPhoneSmsException(
                'Failed to get SMS list: ' . $e->getMessage(),
                $e->getCode(),
                $e
            );
        }
    }

    /**
     * Get single SMS by UUID
     */
    public function getSmsById(string $uuid): SmsResponseData
    {
        $request = new GetSmsRequest($uuid);
        
        try {
            $response = $this->connector->send($request);
            return SmsResponseData::from($response->json());
        } catch (RequestException $e) {
            throw new InexPhoneSmsException(
                'Failed to get SMS: ' . $e->getMessage(),
                $e->getCode(),
                $e
            );
        }
    }
}

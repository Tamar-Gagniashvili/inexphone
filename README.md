# InexPHONE SMS Laravel Package

A Laravel package for integrating with the InexPHONE SMS API, built with Saloon HTTP client and Laravel Data for type-safe DTOs.

## Features

- 🚀 **Full API Coverage**: Support for OTP, SMS, and Blacklist operations
- 🛡️ **Type Safety**: Laravel Data DTOs for all requests and responses
- 🔄 **Modern HTTP Client**: Built with Saloon for robust HTTP handling
- ⚙️ **Configuration**: Flexible configuration with sensible defaults
- 🎯 **Laravel Integration**: Service provider, facade, and auto-discovery
- 🧪 **Well Tested**: Comprehensive test suite with Pest

## Installation

Install the package via Composer:

```bash
composer require caravan/inexphone-sms-laravel
```

Publish the configuration file:

```bash
php artisan vendor:publish --provider="Caravan\InexPhoneSms\InexPhoneSmsServiceProvider" --tag="config"
```

## Configuration

Add your InexPHONE SMS API credentials to your `.env` file:

```env
INEXPHONE_SMS_API_TOKEN=your_api_token_here
INEXPHONE_SMS_DEFAULT_SUBJECT=YourApp
INEXPHONE_SMS_DEFAULT_OTP_EXPIRES_IN=60
INEXPHONE_SMS_DEFAULT_OTP_TEXT="Your verification code is: {{CODE}}"
```

## Usage

### Using the Facade

```php
use Caravan\InexPhoneSms\Facades\InexPhoneSms;

// Send OTP
$response = InexPhoneSms::sendOtp('995591950549', 'MyApp');

// Verify OTP
$response = InexPhoneSms::verifyOtp('995591950549', '1234');

// Send SMS
$response = InexPhoneSms::sendSms('995591950549', 'Hello World!');

// Send Bulk SMS
$response = InexPhoneSms::sendBulkSms(
    ['995591950549', '995591950550'],
    'Bulk message content'
);
```

### Using Dependency Injection

```php
use Caravan\InexPhoneSms\InexPhoneSmsClient;

class SmsService
{
    public function __construct(
        private InexPhoneSmsClient $smsClient
    ) {}

    public function sendWelcomeSms(string $phone): void
    {
        $this->smsClient->sendSms(
            phone: $phone,
            message: 'Welcome to our platform!',
            subject: 'MyApp'
        );
    }
}
```

## API Methods

### OTP Operations

#### Send OTP
```php
$response = InexPhoneSms::sendOtp(
    phone: '995591950549',
    subject: 'MyApp',                    // Optional
    text: 'Code: {{CODE}}',              // Optional
    expiresIn: 120                       // Optional (seconds)
);
```

#### Verify OTP
```php
$response = InexPhoneSms::verifyOtp(
    phone: '995591950549',
    code: '1234'
);
```

### SMS Operations

#### Send Single SMS
```php
$response = InexPhoneSms::sendSms(
    phone: '995591950549',
    message: 'Your message content',
    subject: 'MyApp',                    // Optional
    ignoreBlacklist: false,              // Optional
    submitCallbackUrl: 'https://...',    // Optional
    deliveryCallbackUrl: 'https://...'   // Optional
);
```

#### Send Bulk SMS
```php
$response = InexPhoneSms::sendBulkSms(
    phoneNumbers: ['995591950549', '995591950550'],
    message: 'Bulk message content',
    subject: 'MyApp',                    // Optional
    submitCallbackUrl: 'https://...',    // Optional
    deliveryCallbackUrl: 'https://...'   // Optional
);
```

#### Send Commercial SMS
```php
$response = InexPhoneSms::sendCommercialSms(
    phone: '995591950549',
    message: 'Commercial message',
    subject: '995322492020'              // Phone number as subject
);
```

### SMS Retrieval

#### Get SMS List
```php
$response = InexPhoneSms::getSms(
    page: 1,                             // Optional
    perPage: 20,                         // Optional
    sort: '+createDate',                 // Optional
    subject: 'MyApp',                    // Optional
    dateStart: '01/01/2024',             // Optional
    dateEnd: '31/12/2024'                // Optional
);
```

#### Get Single SMS
```php
$response = InexPhoneSms::getSmsById('uuid-here');
```

## Error Handling

The package throws `InexPhoneSmsException` for API errors:

```php
use Caravan\InexPhoneSms\InexPhoneSmsException;

try {
    $response = InexPhoneSms::sendOtp('995591950549');
} catch (InexPhoneSmsException $e) {
    Log::error('SMS API Error: ' . $e->getMessage());
}
```

## Data Transfer Objects

All responses are returned as strongly-typed Data objects:

```php
$response = InexPhoneSms::sendOtp('995591950549');

// Access response data
echo $response->message;
foreach ($response->data as $otp) {
    echo $otp->attributes->phone;
    echo $otp->attributes->expiresAt;
}
```

## Testing

Run the test suite:

```bash
composer test
```

## Configuration Options

| Option | Default | Description |
|--------|---------|-------------|
| `api_url` | `https://smsservice.inexphone.ge/api/v1` | API base URL |
| `api_token` | `null` | Your API token |
| `default_subject` | `YourApp` | Default SMS subject |
| `default_otp_expires_in` | `60` | Default OTP expiration (seconds) |
| `default_otp_text` | `Your verification code is: {{CODE}}` | Default OTP message |
| `timeout` | `30` | Request timeout (seconds) |
| `retry_attempts` | `3` | Number of retry attempts |
| `retry_delay` | `1000` | Retry delay (milliseconds) |

## License

This package is open-sourced software licensed under the [MIT license](LICENSE.md).

## Credits

- Built with [Saloon](https://docs.saloon.dev/) HTTP client
- Uses [Laravel Data](https://spatie.be/docs/laravel-data) for DTOs
- Created for [InexPHONE SMS API](https://smsservice.inexphone.ge/api/v1/docs)

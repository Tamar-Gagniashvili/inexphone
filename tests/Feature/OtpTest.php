<?php

namespace Caravan\InexPhoneSms\Tests\Feature;

use Caravan\InexPhoneSms\Facades\InexPhoneSms;
use Caravan\InexPhoneSms\Tests\TestCase;
use Illuminate\Support\Facades\Http;

class OtpTest extends TestCase
{
    /** @test */
    public function it_can_send_otp(): void
    {
        Http::fake([
            'test-api.inexphone.ge/*' => Http::response([
                'message' => 'OTP sent successfully',
                'data' => [
                    [
                        'id' => '1',
                        'type' => 'otp',
                        'attributes' => [
                            'phone' => '995591950549',
                            'subject' => 'TestApp',
                            'createdAt' => '2024-01-01T00:00:00Z',
                            'expiresAt' => '2024-01-01T00:01:00Z',
                        ]
                    ]
                ]
            ], 201)
        ]);

        $response = InexPhoneSms::sendOtp('995591950549', 'TestApp');

        $this->assertEquals('OTP sent successfully', $response->message);
        $this->assertCount(1, $response->data);
        $this->assertEquals('995591950549', $response->data[0]->attributes->phone);
    }

    /** @test */
    public function it_can_verify_otp(): void
    {
        Http::fake([
            'test-api.inexphone.ge/*' => Http::response([
                'message' => 'ok'
            ], 200)
        ]);

        $response = InexPhoneSms::verifyOtp('995591950549', '1234');

        $this->assertEquals('ok', $response->message);
    }
}

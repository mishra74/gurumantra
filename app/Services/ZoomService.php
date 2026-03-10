<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ZoomService
{
    public function getToken()
    {
        $response = Http::withBasicAuth(
            config('services.zoom.client_id'),
            config('services.zoom.client_secret')
        )->asForm()->post('https://zoom.us/oauth/token', [
            'grant_type' => 'account_credentials',
            'account_id' => config('services.zoom.account_id')
        ]);

        return $response->json()['access_token'];
    }

    public function createMeeting($topic,$start_time)
    {
        $token = $this->getToken();

        $response = Http::withToken($token)->post(
            'https://api.zoom.us/v2/users/me/meetings',
            [
                "topic"=>$topic,
                "type"=>2,
                "start_time"=>$start_time,
                "duration"=>60,
                "timezone"=>"Asia/Kolkata",
                "settings"=>[
                    "host_video"=>true,
                    "participant_video"=>true,
                    "join_before_host"=>true
                ]
            ]
        );

        return $response->json();
    }
}
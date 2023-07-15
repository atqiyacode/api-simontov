<?php

namespace App\Http\Resources\v1\Client;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Browser;

class ClientLoginHistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = json_decode($this->data);
        $device = Browser::parse($data->user_agent);
        return [
            'date' => Carbon::parse($this->log_date)->isoFormat('LLLL'),
            'device' => [
                'deviceFamily' => $device->deviceFamily(),
                'deviceModel' => $device->deviceModel(),
                'platformName' => $device->platformName(),
                'platformFamily' => $device->platformFamily(),
                'isDesktop' => (bool) $device->isDesktop(),
            ],
            'detail' => $device
        ];
    }
}

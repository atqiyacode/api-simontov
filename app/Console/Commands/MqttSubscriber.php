<?php

namespace App\Console\Commands;

use App\Events\v1\MqttEvent;
use Illuminate\Console\Command;
use PhpMqtt\Client\Facades\MQTT;

class MqttSubscriber extends Command
{
    protected $signature = 'mqtt:subscribe';

    protected $description = 'Subscribe to MQTT topics and process messages';

    public function handle()
    {
        $mqtt = MQTT::connection();
        $mqtt->subscribe(config('app.mqtt_topic'), function (string $topic, string $data) {
            MqttEvent::dispatch([
                "topic" => $topic,
                "data" => $data
            ]);
        }, 1);
        $mqtt->loop(true);
    }
}

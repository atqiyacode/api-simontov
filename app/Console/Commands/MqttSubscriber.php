<?php

namespace App\Console\Commands;

use App\Events\v1\MqttEvent;
use App\Jobs\v1\FlowrateMqttJob;
use Illuminate\Console\Command;
use PhpMqtt\Client\Facades\MQTT;

class MqttSubscriber extends Command
{
    protected $signature = 'mqtt:subscribe';

    protected $description = 'Subscribe to MQTT topics and process messages';

    public function handle()
    {
        $mqtt = MQTT::connection();
        $mqtt->subscribe(config('app.mqtt_topic'), function ($topic, $data) {
            $value = json_decode($data, true);
            dispatch(new FlowrateMqttJob($value));
            // MqttEvent::dispatch([
            //     "topic" => $topic,
            //     "data" => $value
            // ]);
        }, 1);
        $mqtt->loop(true);
    }
}

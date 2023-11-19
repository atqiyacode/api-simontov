<?php

namespace App\Console\Commands;

use App\Jobs\FlowrateMqttJob;
use Illuminate\Console\Command;
use PhpMqtt\Client\Facades\MQTT;

class MqttSubscriber extends Command
{
    protected $signature = 'mqtt:subscribe';

    protected $description = 'Subscribe to MQTT topics and process messages';

    public function handle()
    {
        while (true) {
            $this->info('Subscribing to MQTT topic...');
            $mqtt = MQTT::connection();
            $mqtt->subscribe(config('app.mqtt_topic'), function ($topic, $data) {
                $value = json_decode($data, true);
                $this->info('Received MQTT message data:' . $data);
                dispatch(new FlowrateMqttJob($value));
                $this->info('Success Push to database');
            }, 1);
            $mqtt->loop(true);
        }
    }
}

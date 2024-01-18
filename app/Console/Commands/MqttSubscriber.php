<?php

namespace App\Console\Commands;

use App\Jobs\FlowrateMqttJob;
use App\Models\Topic;
use Illuminate\Console\Command;
use PhpMqtt\Client\Facades\MQTT;

class MqttSubscriber extends Command
{
    protected $signature = 'mqtt:subscribe';

    protected $description = 'Subscribe to MQTT topics and process messages';

    public function handle()
    {
        $topics = Topic::all();
        while (true) {
            // $this->info('Subscribing to MQTT topic...');
            $mqtt = MQTT::connection();
            foreach ($topics as $topic) {
                $mqtt->subscribe($topic->name, function ($topic, $data) {
                    // $this->info('Received MQTT topic : ' . $topic);
                    $value = json_decode($data, true);
                    // $this->info('Received MQTT message data:' . $data);
                    dispatch(new FlowrateMqttJob($value));
                    $this->info('Success Push to Database');
                }, 1);
            }
            $mqtt->loop(true);
        }
    }
}

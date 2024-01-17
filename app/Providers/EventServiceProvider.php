<?php

namespace App\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        $modelsDirectory = app_path('Models');

        // Scan the Models directory for PHP files
        $modelFiles = File::glob($modelsDirectory . '/*.php');

        foreach ($modelFiles as $modelFile) {
            // Extract the model class name from the file path
            $modelName = pathinfo($modelFile, PATHINFO_FILENAME);

            // Build the full class name
            $modelClass = 'App\Models\\' . $modelName;

            // Check if the class exists and is an instance of Illuminate\Database\Eloquent\Model
            if (class_exists($modelClass) && is_subclass_of($modelClass, 'Illuminate\Database\Eloquent\Model')) {
                // Build the observer class name
                $observerClass = 'App\Observers\\' . $modelName . 'Observer';

                // Check if the observer class exists
                if (class_exists($observerClass)) {
                    // Associate the observer with the model
                    $modelClass::observe($observerClass);
                }
            }
        }
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}

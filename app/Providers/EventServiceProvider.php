<?php

namespace App\Providers;

use App\Models\v1\AuthVerificationMethod;
use App\Models\v1\CompanyInformation;
use App\Models\v1\DeveloperNote;
use App\Models\v1\FAQ;
use App\Models\v1\GlobalNotification;
use App\Models\v1\GlobalNotificationUser;
use App\Models\v1\HomeSlider;
use App\Models\v1\MobileAppMenu;
use App\Models\v1\MobileAppServerStatus;
use App\Models\v1\MobileVersion;
use App\Models\v1\PersonalNotification;
use App\Models\v1\PersonalNotificationUser;
use App\Observers\v1\AuthVerificationMethodObserver;
use App\Observers\v1\CompanyInformationObserver;
use App\Observers\v1\DeveloperNoteObserver;
use App\Observers\v1\FAQObserver;
use App\Observers\v1\GlobalNotificationObserver;
use App\Observers\v1\GlobalNotificationUserObserver;
use App\Observers\v1\HomeSliderObserver;
use App\Observers\v1\MobileAppMenuObserver;
use App\Observers\v1\MobileAppServerStatusObserver;
use App\Observers\v1\MobileVersionOberver;
use App\Observers\v1\PermissionObserver;
use App\Observers\v1\PersonalNotificationObserver;
use App\Observers\v1\PersonalNotificationUserObserver;
use App\Observers\v1\RoleObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
        // app server mobile
        MobileAppServerStatus::observe(MobileAppServerStatusObserver::class);

        GlobalNotification::observe(GlobalNotificationObserver::class);
        GlobalNotificationUser::observe(GlobalNotificationUserObserver::class);

        PersonalNotification::observe(PersonalNotificationObserver::class);
        PersonalNotificationUser::observe(PersonalNotificationUserObserver::class);

        MobileVersion::observe(MobileVersionOberver::class);
        MobileAppMenu::observe(MobileAppMenuObserver::class);
        HomeSlider::observe(HomeSliderObserver::class);
        CompanyInformation::observe(CompanyInformationObserver::class);

        // developer
        DeveloperNote::observe(DeveloperNoteObserver::class);
        FAQ::observe(FAQObserver::class);
        AuthVerificationMethod::observe(AuthVerificationMethodObserver::class);

        // role and permission
        Role::observe(RoleObserver::class);
        Permission::observe(PermissionObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}

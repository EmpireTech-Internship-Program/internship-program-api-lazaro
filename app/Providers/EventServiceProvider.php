<?php

namespace App\Providers;

use App\Models\Account;
use App\Models\Agency;
use App\Models\Bank;
use App\Models\Person;
use App\Models\User;
use App\Observers\AccountObserver;
use App\Observers\AgencyObserver;
use App\Observers\BankObserver;
use App\Observers\PersonObserver;
use App\Observers\UserObserver;
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
        User::observe(UserObserver::class);
        Bank::observe(BankObserver::class);
        Agency::observe(AgencyObserver::class);
        Account::observe(AccountObserver::class);
        Person::observe(PersonObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}

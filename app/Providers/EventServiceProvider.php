<?php

namespace App\Providers;

use App\Models\File;
use App\Models\PostArticle;
use App\Models\Slideshow;
use App\Models\User;
use App\Observers\FileObserver;
use Illuminate\Support\Facades\Event;
use App\Observers\PostArticleObserver;
use App\Observers\SlideshowObserver;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

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
        PostArticle::observe(PostArticleObserver::class);
        Slideshow::observe(SlideshowObserver::class);
        File::observe(FileObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}

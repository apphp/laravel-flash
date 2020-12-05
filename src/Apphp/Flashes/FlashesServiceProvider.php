<?php

namespace Apphp\Flashes;

use Illuminate\Support\ServiceProvider;


class FlashesServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of this provider is deferred
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register service provider
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'Apphp\Flashes\SessionFlashesStore'
        );

        $this->app->singleton('flashes', function () {
            return $this->app->make('Apphp\Flashes\FlashesNotifier');
        });
    }

    /**
     * Bootstrap the application events
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../../views', 'flashes');

        $this->publishes([
            __DIR__ . '/../../views' => base_path('resources/views/vendor/flashes')
        ]);
    }

}

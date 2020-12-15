<?php

namespace Apphp\Flash;

use Illuminate\Support\ServiceProvider;


class FlashServiceProvider extends ServiceProvider
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
            'Apphp\Flash\SessionFlashStore'
        );

        $this->app->singleton(
            'flash',
            function () {
                return $this->app->make('Apphp\Flash\FlashNotifier');
            }
        );
    }

    /**
     * Bootstrap the application events
     *
     * @return void
     */
    public function boot()
    {
        $dir = rtrim(__DIR__, '/');

        $this->loadViewsFrom($dir.'/../views', 'flash');

        $this->publishes(
            [
                $dir.'/../views' => base_path('resources/views/vendor/flash')
            ]
        );
    }

}

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

        $this->app->singleton(
            'flashes',
            function () {
                return $this->app->make('Apphp\Flashes\FlashesNotifier');
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
        $dir = trim(__DIR__, '/');

        $this->loadViewsFrom($dir.'/../../views', 'flashes');

        $this->publishes(
            [
                $dir.'/../../views' => base_path('resources/views/vendor/flashes')
            ]
        );
    }

}

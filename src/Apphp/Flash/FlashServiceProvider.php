<?php

namespace Apphp\Flash;

use Illuminate\Support\ServiceProvider;


class FlashServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events
     *
     * @return void
     */
    public function boot()
    {
        // Prepare dir to work in Windows and Linux environments
        $dir = rtrim(__DIR__, '/');

        $this->loadViewsFrom($dir.'/../views', 'flash');

        $this->publishViews($dir);
        $this->publishConfig($dir);
    }

    /**
     * Register service provider
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
     * Publish views
     * @param  string  $dir
     */
    protected function publishViews(string $dir = '')
    {
        $this->publishes([
            $dir.'/../views' => base_path('resources/views/vendor/flash')
        ], 'laravel-flash:views');
    }

    /**
     * Publish config
     * @param  string  $dir
     */
    protected function publishConfig(string $dir = '')
    {
        $this->publishes([
            $dir.'/../../config/flash.php' => config_path('flash.php')
        ], 'laravel-flash:config');
    }

}

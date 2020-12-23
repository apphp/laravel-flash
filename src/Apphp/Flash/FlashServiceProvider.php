<?php

namespace Apphp\Flash;

use Illuminate\Support\ServiceProvider;


class FlashServiceProvider extends ServiceProvider
{

    /**
     * @var string
     */
    private $dir = '';

    public function __construct($app)
    {
        parent::__construct($app);

        // Prepare dir to work in Windows and Linux environments
        $this->dir = rtrim(__DIR__, '/');
    }

    /**
     * Bootstrap the application events
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom($this->dir.'/../views', 'flash');

        $this->publishViews();
        $this->publishConfig();
    }

    /**
     * Register service provider
     *
     * @return void
     */
    public function register()
    {
        // Use the vendor configuration file
        $this->mergeConfigFrom(
            $this->dir.'/../../../config/flash.php',
            'flash'
        );

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
     */
    protected function publishViews()
    {
        $this->publishes(
            [
                $this->dir.'/../views' => base_path('resources/views/vendor/flash')
            ],
            'laravel-flash:views'
        );
    }

    /**
     * Publish config
     */
    protected function publishConfig()
    {
        $this->publishes(
            [
                $this->dir = ''.'/../../../config/flash.php' => config_path('flash.php')
            ],
            'laravel-flash:config'
        );
    }

}

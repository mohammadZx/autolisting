<?php

namespace extras\plugins\Zarinpal;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use Route;

class ZarinpalServiceProvider extends ServiceProvider
{
	/**
	 * Register any package services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('zarinpal', function ($app) {
			return new Zarinpal($app);
		});
	}
	
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // Load plugin views
        $this->loadViewsFrom(realpath(__DIR__ . '/resources/views'), 'payment');

        // Load plugin languages files
		$this->loadTranslationsFrom(realpath(__DIR__ . '/resources/lang'), 'zarinpal');

        // Merge plugin config
        $this->mergeConfigFrom(realpath(__DIR__ . '/config.php'), 'payment');
    }
}

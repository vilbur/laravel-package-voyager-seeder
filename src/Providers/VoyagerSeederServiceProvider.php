<?php namespace vilbur\VoyagerSeeder\Providers;

use Illuminate\Support\ServiceProvider;


class VoyagerSeederServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
		$this->publishes([	__DIR__.'/../../publish/Config'	=> config_path('Voyager'),], 'config');
		$this->publishes([	__DIR__.'/../../publish/Seeds'	=> base_path('database/seeds'),], 'config');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(){
        $this->loadMigrationsFrom(__DIR__.'/../Migrations', 'VoyagerSeeder');
    }

}

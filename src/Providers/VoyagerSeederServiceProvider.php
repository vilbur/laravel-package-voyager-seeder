<?php namespace Vilbur\VoyagerSeeder\Providers;

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
		$this->publishes([	__DIR__.'/../../publish/Config'	=> config_path('Voyager'),], 'VoyagerSeeder');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(){
		$this->app->bind('VoyagerSeeder', function(){
			return new \vilbur\VoyagerSeeder\VoyagerSeeder;
		});
		$this->loadMigrationsFrom(__DIR__.'/../Migrations', 'VoyagerSeeder');

    }

}

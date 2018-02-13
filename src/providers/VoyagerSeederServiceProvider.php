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
		/* PUBLISH */
		$this->publishes([	__DIR__.'/../../publish/config'	=> config_path(),], 'VoyagerSeeder');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(){
		$this->app->bind('VoyagerSeeder', function(){
			return new \Vilbur\VoyagerSeeder\VoyagerSeeder;
		});

		/* CONFIG */
		$this->mergeConfigFrom(	__DIR__.'/../../publish/config/voyager/DataRow.php', 'VoyagerSeeder');

		/* MIGRATIONS */
		$this->loadMigrationsFrom(__DIR__.'/../Migrations', 'VoyagerSeeder');

    }

}

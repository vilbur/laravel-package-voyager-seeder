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
		$this->loadRoutesFrom(	__DIR__.'/../routes/routes.php');
		$this->publishes([	__DIR__.'/../Config/VoyagerSeeder.php' => config_path('VoyagerSeeder.php'),], 'config');
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
        $this->mergeConfigFrom(	__DIR__.'/../Config/VoyagerSeeder.php', 'VoyagerSeeder');
        $this->loadViewsFrom(	__DIR__ . '/../Views', 'VoyagerSeeder');
        $this->loadMigrationsFrom(	__DIR__ . '/../Migrations', 'VoyagerSeeder');
        //$this->loadSeedsFrom(	__DIR__ . '/../Seeds', 'VoyagerSeeder');

    }

}
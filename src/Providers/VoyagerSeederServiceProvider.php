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
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(){
<<<<<<< HEAD
      $this->app->bind('VoyagerSeeder', function(){
            return new \vilbur\VoyagerSeeder\Database\Seeds\VoyagerSeeder;
        });
	  $this->loadMigrationsFrom(__DIR__.'/../Migrations', 'VoyagerSeeder');
=======
        $this->loadMigrationsFrom(__DIR__.'/../Migrations', 'VoyagerSeeder');
>>>>>>> 6f4ec08a91b820d66b4d4bfa49de491a19efa08c
    }

}

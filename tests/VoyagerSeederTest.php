<?php namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

//use Vilbur\VoyagerSeeder\Models\Test\VoyagertestRelated;
//use Vilbur\VoyagerSeeder\Models\DataRow;
use Vilbur\VoyagerSeeder\VoyagerSeeder;

class VoyagerSeederTest extends TestCase
{
	use RefreshDatabase;

   /** PAths to modelsare defined in 'config/voyager/voyager-seeder.paths.models'
     */
    public function test_get_models_from_app()
	{
		$model	= new VoyagerSeeder;
		$model->setModels();
		$this->assertNotEmpty($model->models);
    }


}

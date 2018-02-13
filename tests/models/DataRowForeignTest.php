<?php namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Vilbur\VoyagerSeeder\Models\Test\VoyagertestRelated;
use Vilbur\VoyagerSeeder\Models\DataRow;
use Vilbur\VoyagerSeeder\Models\DataRowForeign;

class DataRowForeignTest extends TestCase
{
	use RefreshDatabase;

   /**
     */
    public function test_set_data_row_foreign()
	{
		$model	= new VoyagertestRelated;
		$foreign_key	= \Schema::getConnection()->getDoctrineSchemaManager()->listTableForeignKeys($model->getTable())[0];
		$DataRowForeign 	= (new DataRowForeign)
							->setModel($model)
							->setForeignKey($foreign_key)
							->fillModel();

		$relationship_details	= json_decode($DataRowForeign->details);
		//dump($DataRowForeign->getAttributes());
		$this->assertEquals('voyagertest', $relationship_details->table);
		$this->assertEquals('Vilbur\VoyagerSeeder\Models\Test\Voyagertest', $relationship_details->model);
    }


}

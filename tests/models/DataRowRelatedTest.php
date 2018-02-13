<?php namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Vilbur\VoyagerSeeder\Models\Test\Voyagertest;
use Vilbur\VoyagerSeeder\Models\Test\VoyagertestRelated;
use Vilbur\VoyagerSeeder\Models\DataRow;
use Vilbur\VoyagerSeeder\Models\DataRowRelated;

class DataRowRelatedTest extends TestCase
{
	use RefreshDatabase;

   /**
     */
    public function test_set_data_row_related()
	{
		//$model_related	= new VoyagertestRelated;
		$model	= new VoyagertestRelated;
		$foreign_key	= \Schema::getConnection()->getDoctrineSchemaManager()->listTableForeignKeys($model->getTable())[0];
		$DataRowRelated 	= (new DataRowRelated)
							->setModel($model)
							->setForeignKey($foreign_key)
							->fillModel();

		$relationship_details	= json_decode($DataRowRelated->details);

 		$this->assertEquals('voyagertest_relateds', $relationship_details->table);
		$this->assertEquals('Vilbur\VoyagerSeeder\Models\Test\VoyagertestRelated', $relationship_details->model);

    }
	
	/** getDataRow
	*/
	public function getModel_DataRowRelated($model){

	}

}

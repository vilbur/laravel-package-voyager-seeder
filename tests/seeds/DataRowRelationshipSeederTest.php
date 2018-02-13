<?php namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Vilbur\VoyagerSeeder\Models\DataRow;
use Vilbur\VoyagerSeeder\Database\Seeds\DataRowRelationshipSeeder;
use Vilbur\VoyagerSeeder\Models\Test\VoyagertestRelated;


class DataRowRelationshipSeederTest extends TestCase
{
	use RefreshDatabase;

   /**
     */
    public function test_set_data_row_related()
	{
		$BreadCreator	= new DataRowRelationshipSeeder(new VoyagertestRelated);
		$BreadCreator->seed();
		$this->assertTrue(true);
    }

	/** getDataRow
	*/
	public function getDataRowRelated($model){
		$foreign_key = \Schema::getConnection()->getDoctrineSchemaManager()->listTableForeignKeys($model->getTable())[0];
		return (new DataRowRelated)
					->setModel($model)
					->setForeignKey($foreign_key)
					->fillModel();
	}

}

<?php namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Voyagertest;
use App\VoyagertestRelated;
use Vilbur\VoyagerSeeder\Models\DataRow;
use Vilbur\VoyagerSeeder\Models\DataRowForeign;

class DataRowForeignTest extends TestCase
{
	use RefreshDatabase;

   /**
     */
    public function test_set_model()
	{
		$DataRowForeign = (new DataRowForeign)->setModel(new VoyagertestRelated);
		$this->assertAttributeEquals(new VoyagertestRelated, 'model', $DataRowForeign);
    }

   /**
     */
    public function test_set_data_row_foreign()
	{
		$DataRowForeign = $this->getDataRowRelated( new VoyagertestRelated);
		//dump($DataRowForeign->getAttributes());
		$this->assertTrue($DataRowForeign->hasRelationship());
    }


	/** getDataRow
	*/
	public function getDataRowRelated($model){
		$foreign_key = \Schema::getConnection()->getDoctrineSchemaManager()->listTableForeignKeys($model->getTable())[0];
		return (new DataRowForeign)
							->setModel($model)
							->setForeignKey($foreign_key)
							->fillModel();
	}

}

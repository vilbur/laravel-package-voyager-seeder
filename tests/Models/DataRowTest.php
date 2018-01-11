<?php namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Voyagertest;
use App\VoyagertestRelated;
use vilbur\VoyagerSeeder\Models\DataRowColumn;

class DataRowTest extends TestCase
{
	use RefreshDatabase;

   /**
     */
    public function test_set_data_row()
	{
		$DataRow = (new DataRowColumn)->setModel(new VoyagertestRelated)->setField('title')->fillModel();
		$this->assertObjectHasAttribute('model', $DataRow);
    }

}

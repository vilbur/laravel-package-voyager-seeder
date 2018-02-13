<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Vilbur\VoyagerSeeder\Database\Seeds\DataRowColumnSeeder;
use Vilbur\VoyagerSeeder\Models\Test\Voyagertest;
use Vilbur\VoyagerSeeder\Models\Test\VoyagertestRelated;

class DataRowColumnSeederTest extends TestCase
{
	use RefreshDatabase;

	/**
	*/
	public function test_is_count_of_saved_models_equal_xount_of_columns()
	{
		$VoyagertestRelated	= new VoyagertestRelated;
		$DataRowColumnSeeder	= new DataRowColumnSeeder($VoyagertestRelated);
		$DataRowColumnSeeder->seed();
		$this->assertEquals( count($DataRowColumnSeeder->DataType->dataRows), count($this->getColumns($VoyagertestRelated)) );
	}


	/**
	*/
	public function getColumns($VoyagertestRelated)
	{
		return	\DB::select('show columns from ' .$VoyagertestRelated->getTable());
	}
}

<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Vilbur\VoyagerSeeder\Database\Seeds\DataRowRelationshipSeeder;
use App\Voyagertest;
use App\VoyagertestRelated;

class DataRowColumnSeederTest extends TestCase
{
	use RefreshDatabase;

	/**
	*/
	public function test_exist_some_models_for_seeding()
	{
		$VoyagertestRelated	= new VoyagertestRelated;
		$BreadCreator	= new DataRowColumnSeeder($VoyagertestRelated);
		$BreadCreator->seed();
		$this->assertEquals( count($BreadCreator->DataType->dataRows), count($this->getColumns($VoyagertestRelated)) );
	}


	/**
	*/
	public function getColumns($VoyagertestRelated)
	{
		return	\DB::select('show columns from ' .$VoyagertestRelated->getTable());
	}
}

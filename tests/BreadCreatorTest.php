<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use vilbur\VoyagerSeeder\BreadCreator;
use App\Voyagertest;

class BreadCreatorTest extends TestCase
{
	use RefreshDatabase;

   /**
     * A basic test example.
     *
     * @return void
     */
    public function testVoyagerSeeder(){

		$this->assertTrue(true);
    }
	/**
	*/
	public function test_exist_some_models_for_seeding()
	{
		$BreadCreator = new BreadCreator(new Voyagertest);
		$BreadCreator->createBread();
		//(new BreadCreator)->createBreads();
		$this->assertTrue(true);

		//$this->assertTrue((new BreadCreator)->createBreads());
	}
}

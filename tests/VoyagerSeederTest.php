<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use vilbur\VoyagerSeeder\Seeds\VoyagerSeeder;

class VoyagerSeederTest extends TestCase
{
	use RefreshDatabase;

   /**
     * A basic test example.
     *
     * @return void
     */
    //public function testVoyagerSeeder(){

		//$this->assertTrue(true);
    //}
	/**
	*/
	public function test_exist_some_models_for_seeding()
	{
		$VoyagerSeeder = new VoyagerSeeder;
		$VoyagerSeeder->setModels();
		$this ->assertEquals(gettype($VoyagerSeeder->models) , 'array');
	}
}

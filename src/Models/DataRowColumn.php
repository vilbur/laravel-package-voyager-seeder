<?php namespace vilbur\VoyagerSeeder\Models;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Output\ConsoleOutput;

/**
 */
class DataRowColumn extends DataRow{


	/*
	|--------------------------------------------------------------------------
	| FILL ATTRIBUTES
	|--------------------------------------------------------------------------
	|
	*/
    /**
     */
    public function fillModel(){
		$this->fillModelAttributes();
		return $this;
    }



}

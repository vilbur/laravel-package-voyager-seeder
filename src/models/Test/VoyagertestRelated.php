<?php namespace Vilbur\VoyagerSeeder\Models\Test;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Output\ConsoleOutput;

/**
 */
class VoyagertestRelated extends Model
{

	public $table = 'voyagertest_relateds'; // model for defining BREAD


	public function voyagertest(){
		return $this->belongsTo('Vilbur\VoyagerSeeder\Models\Test\Voyagertest');
	}



}

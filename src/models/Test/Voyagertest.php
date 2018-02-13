<?php namespace Vilbur\VoyagerSeeder\Models\Test;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Output\ConsoleOutput;

/**
 */
class Voyagertest extends Model
{

	public $table = 'voyagertest'; // model for defining BREAD


	public function voyagertestRelateds(){
		return $this->hasMany('Vilbur\VoyagerSeeder\Models\Test\VoyagertestRelated');
	}



}

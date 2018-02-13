<?php namespace Vilbur\VoyagerSeeder;

use Illuminate\Database\Seeder;
use Symfony\Component\Finder\Finder;
use Vilbur\VoyagerSeeder\Models\DataType;
use Vilbur\VoyagerSeeder\Database\Seeds\DataRowColumnSeeder;
use Vilbur\VoyagerSeeder\Database\Seeds\PermisionSeeder;
use Vilbur\VoyagerSeeder\Database\Seeds\DataRowRelationshipSeeder;

class VoyagerSeeder extends Seeder
{

	/** all models in app without BREAD
	 */
	public $models	= [];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
		$this->setModels();
		$this->seedDataRowsForColumns();
		$this->seedDataRowsForRelationship();
		$this->seedPermisions();
    }
	/**
	*/
	public function seedDataRowsForColumns()
	{
		foreach($this->models as $model)
			if(!$this->breadExists($model))
				(new DataRowColumnSeeder($model))->seed();
	}
	/**
	*/
	public function seedDataRowsForRelationship()
	{
		foreach($this->models as $model)
			(new DataRowRelationshipSeeder($model))->seed();
	}
	/**
	*/
	public function seedPermisions()
	{
		foreach($this->models as $model)
			if($this->breadExists($model))
				(new PermissionSeeder($model))->seed();
	}
	/** setModels
	 */
	public function setModels(){

		$files = Finder::create()
					->in( $this->getPathsToModelsFromConfig() )
					->depth('== 0')
					->name('*.php');

		foreach($files as $file)
			$this->models[] = app($this->getNamespace( $file->getRealpath()));
	}
	/**
	*/
	public function getPathsToModelsFromConfig()
	{
		return array_filter(\Config::get('voyager.voyager-seeder.paths.models'), function($path) {
					if( file_exists($path) && ! $this->isDirEmpty($path) )
						return $path;
				});
	}
	/**
	*/
	public function isDirEmpty($dir_path)
	{
		if (!is_readable($dir_path)) return false;
		return (count(scandir($dir_path)) == 2);
	}

	/** Get namespace from file
	 */
	public function getNamespace($path) {
		$lines	= file($path);
		$replaced	= preg_grep('/namespace /', $lines);
		$namespaceLine	= array_shift($replaced);
		$match	= [];
		preg_match('/namespace (.*);[\r\n$]/', $namespaceLine, $match);
		$namespace = array_pop($match);
		return $namespace .'\\'.  pathinfo($path, PATHINFO_FILENAME );
	}

	/** breadExists
	 */
	private function breadExists($model){
		return DataType::where('name', $model->getTable())->first();
	}

}

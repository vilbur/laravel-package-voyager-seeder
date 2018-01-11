<?php namespace vilbur\VoyagerSeeder\Database\Seeds;

use Illuminate\Database\Seeder;
use Symfony\Component\Finder\Finder;
use vilbur\VoyagerSeeder\Models\DataType;
use vilbur\VoyagerSeeder\Database\Seeds\DataRowColumnSeeder;
use vilbur\VoyagerSeeder\Database\Seeds\PermisionSeeder;
use vilbur\VoyagerSeeder\Database\Seeds\DataRowRelationshipSeeder;

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
					->in(app_path())
					->depth('== 0')
					->notName('User.php') // exclude voyager classes
					->name('*.php');

		foreach($files as $file)
			$this->models[] = app(preg_replace('/(.*)\.php/', '\App\\\$1', $file->getFilename()));
	}

	/** breadExists
	 */
	private function breadExists($model){
		return DataType::where('name', $model->getTable())->first();
	}

}

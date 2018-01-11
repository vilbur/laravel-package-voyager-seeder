<?php namespace vilbur\VoyagerSeeder\Seeds;

use Illuminate\Database\Seeder;
use Symfony\Component\Finder\Finder;
namespace vilbur\VoyagerSeeder\Seeds\DataRowColumnSeeder;

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
		$this->seedDataRowsForColumns();
		$this->seedDataRowsForRelationship();
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
		//foreach($this->models as $model)
			//if(!$this->breadExists($model))
				//(new DataRowColumnSeeder($model))->seed();
	}
	/** setModels
	 */
	public function setModels(){
		$files = Finder::create()
					->in(app_path())
					->depth('== 0')
					->notName('(DataType|DataRow|User)') // exclude voyager classes
					->name('*.php');

		foreach($files as $file)
			$this->models[] = app(preg_replace('/(.*)\.php/', '\App\\\$1', $file->getFilename()));
	}

	/** breadExists
	 */
	private function breadExists($model){
		return \App\DataType::where('name', $model->getTable())->first();
	}

}
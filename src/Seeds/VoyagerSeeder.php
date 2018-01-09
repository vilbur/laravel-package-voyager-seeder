<?php namespace vilbur\VoyagerSeeder\Seeds;

use Illuminate\Database\Seeder;
use Symfony\Component\Finder\Finder;
//use App\Vilbur\Voyager\BreadSeeder\BreadCreator;

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


//        $this->setModels();
//		//dump($this->models);
//
//		if(count($this->models))
//			foreach($this->models as $model)
//				(new BreadCreator)->createBread($model);
    }

	/** setModels
	 */
	public function setModels(){
		//$this->models = 'models';
		$files = Finder::create()
					->in(app_path())
					->depth('== 0')
					->notName('(DataType|DataRow|User)') // exclude voyager classes
					->name('*.php');
		//dump($files);
		foreach($files as $file)
			$this->setModel(app(preg_replace('/(.*)\.php/', '\App\\\$1', $file->getFilename())));
		//dump($this->models);

	}

	/** setModel
	 */
	public function setModel($model){
		if(!$this->breadExists($model))
			$this->models[] = $model;
	}
	/** breadExists
	 */
	private function breadExists($model){
		return \App\DataType::where('name', $model->getTable())->first();
	}

}
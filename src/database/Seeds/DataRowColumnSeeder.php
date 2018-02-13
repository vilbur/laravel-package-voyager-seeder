<?php namespace Vilbur\VoyagerSeeder\Database\Seeds;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Output\ConsoleOutput;

use Vilbur\VoyagerSeeder\Models\DataType;
use Vilbur\VoyagerSeeder\Models\DataRowColumn;

/* Seed 'data_rows' for NON-RELATIONSHIP columns
 *
 */
class DataRowColumnSeeder {

	/**
     */
	private $model;
	/**
	*/
	public $DataType;

	public function __construct(Model $model){
		$this->model	= $model;
		$this->DataType	= new DataType;
	}
	/** Create Bread for model
	 */
	public function seed()
	{
		$this->createDataType();
		$this->createDataRowForColumns();
	}
	/**
	*/
	private function createDataType()
	{
		$this->DataType->fillAttributes($this->model)->save();
	}
	/*
	|--------------------------------------------------------------------------
	| DataRows
	|--------------------------------------------------------------------------
	|
	|
	*/
	/**
	 */
	private function createDataRowForColumns(){
		$DataRows = [];
		foreach (\DB::select('show columns from ' . $this->model->getTable() ) as $column)
			$DataRows[] = (new DataRowColumn)->setModel($this->model)->setField($column->Field)->fillModel();

		$this->DataType->dataRows()->saveMany($DataRows);
	}



}
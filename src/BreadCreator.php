<?php namespace vilbur\VoyagerSeeder;

use Symfony\Component\Console\Output\ConsoleOutput;
//use \App\DataRow;

class BreadCreator {

	/**
     */
	public $foreign_keys = [];

	public $DataType;
	public $DataRow;

	public function __construct($model){
		$this->model	= $model;
		//dump($this->model);
		//$this->DataType	= new \App\DataType;
		//$this->DataRow	= new \App\DataRow;
	}
	/**
	*/
	public function createBreads()
	{

		return true;
	}
	/** Create Bread for model
	 */
	public function createBread(){
		//dump('createBread');
		$this->setForeignKeys();

		$this->DataType->fillAttributes($model)->save();
		
		//$this->createDataRowForColumns();
		//$this->createDataRowForForeign();
		//$this->createDataRowForRelated();
		//
		//(new ConsoleOutput())->writeln('BREAD created for model: '.get_class($model));
	}
	/** createForeignKeys
	 */
	private function setForeignKeys(){
		$this->foreign_keys = \Schema::getConnection()->getDoctrineSchemaManager()->listTableForeignKeys($this->model->getTable());
		dump($this->foreign_keys);
	}

	/*
	|--------------------------------------------------------------------------
	| DataRows
	|--------------------------------------------------------------------------
	|
	|
	*/
	///**
	// */
	//private function createDataRowForColumns(){
	//	$DataRows = [];
	//	foreach (\DB::select('show columns from ' . $this->model->getTable() ) as $column)
	//		$DataRows[] = (new DataRow($this->model))->fillModel($column->Field);
	//	$this->DataType->dataRows()->saveMany($DataRows);
	//}
	///**
	// */
	//private function createDataRowForForeign(){
	//	$DataRows = $this->getRelationshipDataRows('foreign');
	//	$this->DataType->dataRows()->saveMany($DataRows);
	//	//dump($DataRows);
	//}
	///**
	// */
	//private function createDataRowForRelated(){
	//	$DataRows = $this->getRelationshipDataRows('related');
	//	foreach( $DataRows as $DataRow)
	//		//if($DataRow->hasRelationship())
	//		//dump($DataRow->hasRelationship());
	//		if($DataRow->relationship!==null)
	//			\App\DataType::where('name', $DataRow->relationship->getParent()->getTable())
	//				->first()
	//				->dataRows()
	//				->save($DataRow);
	//}
	//
	///** get filled DataRow model for relationship
	// */
	//private function getRelationshipDataRows($relationship_type){
	//	$DataRows = [];
	//	foreach( $this->foreign_keys as $foreign_key )
	//		$DataRows[] = (new \App\DataRow($this->model))->fillModel($foreign_key->getForeignTableName())
	//										  ->getRelationshipModelTMP($relationship_type, $foreign_key);
	//
	//	return $DataRows;
	//}



}
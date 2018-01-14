<?php namespace Vilbur\VoyagerSeeder\Database\Seeds;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Output\ConsoleOutput;

use Vilbur\VoyagerSeeder\Models\DataType;
use Vilbur\VoyagerSeeder\Models\DataRowForeign;
use Vilbur\VoyagerSeeder\Models\DataRowRelated;

class DataRowRelationshipSeeder
{

	/**
     */
	private $model;
	/**
	*/
	public $DataType;

	public function __construct(Model $model){
		$this->model	= $model;
		$this->setForeignKeys();

	}
	/** Create Bread for model
	 */
	public function seed()
	{
		foreach($this->foreign_keys as $foreign_key)
			$this->createDataRowsForForeignKey($foreign_key);
	}
	/**
	*/
	private function createDataRowsForForeignKey($foreign_key)
	{
		$DataRowForeign = $this->getDataRow(new DataRowForeign, $foreign_key);
		//dump($DataRowForeign->getAttributes());
		$this->saveDataRows($DataRowForeign, $this->model->getTable());

		$DataRowRelated = $this->getDataRow(new DataRowRelated, $foreign_key);
		//dump($DataRowRelated->getAttributes());
		$this->saveDataRows($DataRowRelated, $DataRowRelated->getRelatedTable());

	}
	/**
	*/
	private function getDataRow($DataRow, $foreign_key)
	{
		return $DataRow->setModel($this->model)->setForeignKey($foreign_key)->fillModel();
	}
	/**
	*/
	private function saveDataRows($DataRow, $related_table)
	{
		$DataType = $DataRow->hasRelationship() ? DataType::where('name', $related_table)->first() : null;
		if($DataType)
			$DataType->dataRows()->save($DataRow);
	}

	/** createForeignKeys
	 */
	private function setForeignKeys(){
		$this->foreign_keys = \Schema::getConnection()->getDoctrineSchemaManager()->listTableForeignKeys($this->model->getTable());
	}


}

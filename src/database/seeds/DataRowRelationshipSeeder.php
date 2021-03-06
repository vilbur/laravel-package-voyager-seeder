<?php namespace Vilbur\VoyagerSeeder\Database\Seeds;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Output\ConsoleOutput;

use Vilbur\VoyagerSeeder\Models\DataType;
use Vilbur\VoyagerSeeder\Models\DataRowForeign;
use Vilbur\VoyagerSeeder\Models\DataRowRelated;
use Vilbur\VoyagerSeeder\Models\DataRow;

/* Seed 'data_rows' for RELATIONSHIP columns
 *
 */
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
		$this->seedDataRowForeign($foreign_key);
		$this->seedDataRowRelated($foreign_key);
	}
	/**
	*/
	private function seedDataRowForeign($foreign_key)
	{
		$DataRowForeign = $this->getDataRow(new DataRowForeign, $foreign_key);
		$this->saveDataRows($DataRowForeign, $this->model->getTable());
	}
	/**
	*/
	private function seedDataRowRelated($foreign_key)
	{
		$DataRowRelated = $this->getDataRow(new DataRowRelated, $foreign_key);
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
		if($DataType && ! DataRow::where('field', $DataRow->field)->first() )
			$DataType->dataRows()->save($DataRow);
	}

	/** createForeignKeys
	 */
	private function setForeignKeys(){
		$this->foreign_keys = \Schema::getConnection()->getDoctrineSchemaManager()->listTableForeignKeys($this->model->getTable());
	}


}

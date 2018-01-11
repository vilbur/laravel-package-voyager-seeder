<?php namespace vilbur\VoyagerSeeder\Models;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Output\ConsoleOutput;

/**
 */
class DataRow extends Model
{

	public $table = 'data_rows'; // model for defining BREAD

    /**
     * @var array
     */
    protected $fillable = ['data_type_id', 'field', 'type', 'display_name', 'required', 'browse', 'read', 'edit', 'add', 'delete', 'details', 'order'];
    /** Disable timestamps
     */
	public $timestamps = false;
    /** Model for which will be BREAD created
     */
	protected $model;
    /**
     */
	protected $relationship;

    /**
     */
	public function setModel($model){
		//dump('MODEL');
		$this->model	= $model;
		return $this;
	}
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dataType(){
        return $this->belongsTo('\vilbur\VoyagerSeeder\Models\DataType');
    }
	/*
	|--------------------------------------------------------------------------
	| FILL ATTRIBUTES
	|--------------------------------------------------------------------------
	|
	*/

    /**
     */
    protected function fillModelAttributes(){
		$this->setDisplayName();
		$this->fillWithConfig('Voyager.DataRow.defaults');
		$this->fillWithConfig('Voyager.DataRow.'.$this->field);
		$this->fillWithConfig('Voyager.'.$this->getModelName().'.'.$this->field);
		//$this->convertDetailsToJson();
		return $this;
    }
	/** fill with default values in Config
	 *  Config\voyager.data_rows.defaults
	 */
	protected function fillWithConfig($config){
		if(\Config::has($config))
			$this->fill(\Config::get($config));
	}
	/** setField
	 */
	public function setField($field){
		$this->field	= $field;
		return $this;
	}
	/**
	 */
	protected function setDisplayName(){
		$this->display_name	= title_case(preg_replace('/_/', ' ', $this->field));
	}

	/** has $this->model Relationship ?
	 * @return boolean
	 */
	public function hasRelationship(){
		return $this->relationship !== null;
	}
	/** @return string
	 */
	protected function getModelName(){
		//dump($this->model);
		return basename(get_class($this->model));
	}



}

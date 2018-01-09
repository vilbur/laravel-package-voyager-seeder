<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Output\ConsoleOutput;

/**
 */
class DataRow extends Model{
    /**
     * @var array
     */
    protected $fillable = ['data_type_id', 'field', 'type', 'display_name', 'required', 'browse', 'read', 'edit', 'add', 'delete', 'details', 'order'];
    /** Disable timestamps
     */
	public $timestamps = false;
    /** Model for which will be BREAD created
     */
	private $model;
    /**
     */
	private $relationship;
    /**
     */
	private $foreign_key;
    /**
     */
	public function __construct(Model $model=null){
		$this->model	= $model;
	}
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dataType(){
        return $this->belongsTo('App\DataType');
    }
	/*
	|--------------------------------------------------------------------------
	| FILL ATTRIBUTES
	|--------------------------------------------------------------------------
	|
	*/
    /**
     */
    public function fillModel($field){
		$this->setField($field);
		$this->setDisplayName();
		$this->fillWithConfig('Voyager.DataRow.defaults');
		$this->fillWithConfig('Voyager.DataRow.'.$field);
		$this->fillWithConfig('Voyager.'.$this->getModelName().'.'.$field);
		$this->convertDetailsToJson();
		return $this;
    }
	/** fill with default values in Config
	 *  Config\voyager.data_rows.defaults
	 */
	private function fillWithConfig($config){
		if(\Config::has($config))
			$this->fill(\Config::get($config));
	}
    /**
	 * @param Doctrine\DBAL\Schema\ForeignKeyConstraint $foreign_key
     */
    public function getRelationshipModelTMP($relationship_type, $foreign_key){
		$this->foreign_key	= $foreign_key;
		$related_model	= $relationship_type=='foreign' ? $this->model	: app('\App\\'.$this->getForeignModel());
		$relation_method	= $relationship_type=='foreign' ? $this->getForeignModel()	: str_plural($this->getModelName());
		$this->setRelationship($related_model, $relation_method );
		if($this->hasRelationship())
			$this->fillRelationshipAttributes();
		return $this;
    }
	/** fill Relationship Attributes
	 */
	private function fillRelationshipAttributes(){
		$this->type	= 'relationship';
		$this->fillWithConfig('Voyager.'.$this->getModelName().'.'.$this->getRelatedModelName());
		$this->setRelationshipDetails();
		$this->setField();
		$this->setDisplayName();
		$this->convertDetailsToJson();
	}
	/*
	|--------------------------------------------------------------------------
	| SETTERS
	|--------------------------------------------------------------------------
	|
	*/
	/** set Relationship method
	 *  @return boolean
	 */
	private function setRelationship($related_model, $relation_method){
		$this->relationship	= method_exists($related_model, $relation_method) ? $related_model->{$relation_method}() : null;
		if(!$this->relationship)
			(new ConsoleOutput())->writeln('WARNING: Relationship method does not exists: '.get_class($related_model).'->'.$relation_method.'()');
	}
	/** setField
	 */
	private function setField($field=null){
		$this->field	= $field ? $field : $this->getFieldRorRelationship();
	}
	/**
	 */
	private function setDisplayName(){
		if($this->hasRelationship()){
			$related_model_name	= preg_replace('/(?<!^)([A-Z])/', ' $1', $this->getRelatedModelName() );
			$this->display_name	= preg_match('/many/i', $this->getRelationType()) ? str_plural($related_model_name) : $related_model_name;
		}else
			$this->display_name	= title_case(preg_replace('/_/', ' ', $this->field));
	}
	/*
	|--------------------------------------------------------------------------
	| RELATIONSHIPS DETAILS ATTRIBUTE
	|--------------------------------------------------------------------------
	|
	*/
	/** setRelationshipDetails
	 */
	private function setRelationshipDetails(){
		//if(!isset($this->attributes['details']))
		$this->attributes['details'] = [];

		$this->setDetailAttribute('table',	$this->relationship->getRelated()->getTable());
		$this->setDetailAttribute('model',	'App\\' . $this->getRelatedModelName());
		$this->setDetailAttribute('type',	camel_case($this->getRelationType())); // get E.G: 'BelongsTo' from '\Illuminate\Database\Eloquent\Relations\BelongsTo'

		$this->setDetailAttribute('column',	$this->foreign_key->getLocalColumns()[0]);
		$this->setDetailAttribute('key',	$this->foreign_key->getForeignColumns()[0]);
		$this->setDetailAttribute('label',	$this->getForeignDisplayColumn($this->foreign_key->getForeignTableName()));

		$this->setDetailAttribute('pivot_table',	'');
		$this->setDetailAttribute('pivot',	0);
	}
	/** get value from Model->voyager[foreign_key][$key]
	 *		E.G: Model->data_rows['relationship']['user_id']['label']
	 * set value to $this->details if not set
	 */
	private function setDetailAttribute($key, $value){
		if (!array_key_exists($key, $this->attributes['details']))
			$this->attributes['details'][$key] = $value;
	}
	/*
	|--------------------------------------------------------------------------
	| RELATIONSHIP GETTERS
	|--------------------------------------------------------------------------
	|
	*/
	/** has $this->model Relationship ?
	 * @return boolean
	 */
	public function hasRelationship(){
		return $this->relationship !== null;
		//return isset($this->relationship);
		//return false;
	}
	/** @return string
	 */
	public function getModelName(){
		return basename(get_class($this->model));
	}
	/** setField
	 */
	private function getFieldRorRelationship(){
		return snake_case(basename(get_class($this->relationship->getParent())).'_'.strtolower($this->getRelationType()).basename($this->details['model']).'_relationship'); // get string E.G: 'project_belongs_to_category_project_relationship'
	}
	/** get Foreign Model Name
	 * @return string name of foreign model
	 */
	private function getForeignModel(){
		return str_singular(studly_case($this->foreign_key->getForeignTableName()));
	}
	/** Get column to be shown instead of 'id'
	 *
	 * @return string 'title|name' defined, else return 'id'
	 */
	private function getForeignDisplayColumn($related_table){
		foreach(['name', 'title', 'id'] as $column)
			if(\Schema::hasColumn($related_table, $column))
				return $column;
	}
	/** getRelationType
	 * @return 'hasOne|hasMany|belongsTo|belongsToMany'
	 */
	private function getRelationType(){
		return basename(get_class($this->relationship));
	}

	/* getRelatedModelName
	 */
	private function getRelatedModelName(){
		return basename(get_class($this->relationship->getRelated()));
	}

	/*
	|--------------------------------------------------------------------------
	| HELPERS
	|--------------------------------------------------------------------------
	|
	*/
	/** convertDetailsToJson
	 */
	private function convertDetailsToJson(){
		$this->attributes['details'] = count($this->attributes['details']) ? json_encode($this->attributes['details']) : '';
		return $this;
	}

}

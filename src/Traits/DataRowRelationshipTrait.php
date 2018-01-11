<?php namespace vilbur\VoyagerSeeder\Traits;

use Symfony\Component\Console\Output\ConsoleOutput;

/**
 */
trait DataRowRelationshipTrait{

    /**
     */
	protected $foreign_key;
	/**
	*/
	public function setForeignKey($foreign_key)
	{
		$this->foreign_key	= $foreign_key;
		$this->setField($foreign_key->getForeignTableName());
		return $this;
	}

	/*
	|--------------------------------------------------------------------------
	| FILL ATTRIBUTES
	|--------------------------------------------------------------------------
	|
	*/
	/** fill Relationship Attributes
	 */
	protected function fillRelationshipAttributes(){
		$this->fillModelAttributes();
		$this->setRelationshipDetails();
		$this->setFieldforRelationship();
		$this->setDisplayName();
		$this->fillWithConfig('Voyager.'.$this->getModelName().'.'.$this->getRelatedModelName());
		$this->type	= 'relationship';
		$this->convertDetailsToJson();
		//dump($this->getAttributes());
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
	protected function setRelationship($related_model, $relation_method){
		//dump('setRelationship');
		$this->relationship	= method_exists($related_model, $relation_method) ? $related_model->{$relation_method}() : null;
		if($this->relationship)
			$this->fillRelationshipAttributes();
		else
			(new ConsoleOutput())->writeln('WARNING: Relationship method does not exists: '.get_class($related_model).'->'.$relation_method.'()');
	}
	/**
	 */
	protected function setDisplayName(){
		$related_model_name	= preg_replace('/(?<!^)([A-Z])/', ' $1', $this->getRelatedModelName() );
		$this->display_name	= preg_match('/many/i', $this->getRelationType()) ? str_plural($related_model_name) : $related_model_name;
	}
	/*
	|--------------------------------------------------------------------------
	| RELATIONSHIPS DETAILS ATTRIBUTE
	|--------------------------------------------------------------------------
	|
	*/
	/** setRelationshipDetails
	 */
	protected function setRelationshipDetails(){
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
	protected function setDetailAttribute($key, $value){
		if (!array_key_exists($key, $this->attributes['details']))
			$this->attributes['details'][$key] = $value;
	}
	/*
	|--------------------------------------------------------------------------
	| RELATIONSHIP GETTERS
	|--------------------------------------------------------------------------
	|
	*/
	/* getRelatedModelName
	 */
	public function getRelatedTable(){
		return $this->relationship->getParent()->getTable();
	}
	/** setField
	 */
	protected function setFieldforRelationship(){
		$this->setField(snake_case(basename(get_class($this->relationship->getParent())).'_'.strtolower($this->getRelationType()).basename($this->details['model']).'_relationship')); // get string E.G: 'project_belongs_to_category_project_relationship'
	}

	/* getRelatedModelName
	 */
	protected function getRelatedModelName(){
		return basename(get_class($this->relationship->getRelated()));
	}
	/** get model
	 * @return string name of foreign model
	 */
	protected function getForeignModel(){
		return str_singular(studly_case($this->foreign_key->getForeignTableName()));
	}
	/** Get column to be shown instead of 'id'
	 *
	 * @return string 'title|name' defined, else return 'id'
	 */
	protected function getForeignDisplayColumn($related_table){
		foreach(['name', 'title', 'id'] as $column)
			if(\Schema::hasColumn($related_table, $column))
				return $column;
	}
	/** getRelationType
	 * @return 'hasOne|hasMany|belongsTo|belongsToMany'
	 */
	protected function getRelationType(){
		return basename(get_class($this->relationship));
	}


	/*
	|--------------------------------------------------------------------------
	| HELPERS
	|--------------------------------------------------------------------------
	|
	*/
	/** convertDetailsToJson
	 */
	protected function convertDetailsToJson(){
		$this->attributes['details'] = count($this->attributes['details']) ? json_encode($this->attributes['details']) : '';
		return $this;
	}

}

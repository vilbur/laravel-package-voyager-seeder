<?php namespace Vilbur\VoyagerSeeder\Models;

use Illuminate\Database\Eloquent\Model;

/** Model for Voyager`s 'data_types' table
 */
class DataType extends Model{

	public $model = ''; // model for defining BREAD
    /**
     * @var array
     *  Order is important for auto rich of values
     */
    protected $fillable = ['name', 'slug', 'model_name', 'display_name_singular', 'display_name_plural', 'icon', 'policy_name', 'controller', 'description', 'generate_permissions', 'server_side', 'created_at', 'updated_at'];
    /**
     * Default values for attributes
     */
    protected $attributes = [
		'icon'	=> NULL,
		'policy_name'	=> NULL,
		'generate_permissions'	=> 1,
		'server_side'	=> 0,
	];


	/** Fill $this->attributes if method for field exists
	*/
	function fillAttributes($model){
		$this->model	= $model;
		foreach($this->fillable as $field)
			$this->fillAttribute(camel_case($field));
		return $this;
	}
	/** run Method for fill $this->attributes
	*/
	function fillAttribute($method){
		if(method_exists($this, $method))
			$this->{$method}();
	}
	/*
	|--------------------------------------------------------------------------
	| RELATIONSHIPS
	|--------------------------------------------------------------------------
	|
	|
	*/
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dataRows(){
        return $this->hasMany('\Vilbur\VoyagerSeeder\Models\DataRow');
    }
	/*
	|--------------------------------------------------------------------------
	| FILL ATTRIBUTES
	|--------------------------------------------------------------------------
	|
	|
	*/
	/** Set name
	*/
	function name(){
		$this->name = $this->hasVoyager('name')?: $this->model->getTable();
	}
	/** Set model_name
	*/
	function modelName(){
		$this->model_name = $this->hasVoyager('model_name')?: get_class($this->model);
	}
	/** Set slug
	*/
	function slug(){
		$this->slug = $this->hasVoyager('slug')?: str_slug( $this->name, '-');
	}
	/** Set display_name_singular
	*/
	function displayNameSingular(){
		$this->display_name_singular = $this->hasVoyager('display_name_singular')?: preg_replace('/(?<!^)([A-Z])/', ' $1', basename( $this->model_name));
	}
	/** Set display_name_plural
	*/
	function displayNamePlural(){
		$this->display_name_plural = $this->hasVoyager('display_name_plural')?: title_case(preg_replace('/_/', ' ', $this->name));
	}
	/** Set description
	 */
	public function description(){
		$this->description = $this->hasVoyager('description')?: '';
	}

	/*
	|--------------------------------------------------------------------------
	| HELPERS
	|--------------------------------------------------------------------------
	|
	|
	*/
	/** try to get value from array 'voyager' defined in model
	 */
	public function hasVoyager($property){
		if(isset($this->model->voyager[$property]))
			return $this->model->voyager[$property];
	}
	/** get Controller If Exists
	 *  DEFAULT BREAD CONTROLER IS USED NOW, THIS METHOD IS UNUSED NOW
	 */
	public function getControllerIfExists(){
		$controller_name = preg_replace('/App\\\\(.*)/', 'App\Http\Controllers\\\$1Controller', $this->model_name);
		return class_exists($controller_name)? $controller_name : '';
		//return $controller_name;
	}

}

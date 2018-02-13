<?php namespace Vilbur\VoyagerSeeder\Database\Seeds;

use Illuminate\Database\Eloquent\Model;

use TCG\Voyager\Models\Role;
use TCG\Voyager\Models\Permission;

class PermissionSeeder {

	/**
     */
	private $model;
	/**
	*/
	//public $Permissions;

	public function __construct(Model $model){
		$this->model	= $model;
	}
	/** Create Bread for model
	 */
	public function seed()
	{
		$this->savePermissions();
		if(!$this->getPermissions());
			$this->adminRole()->permissions()->saveMany($this->getPermissions());
	}
	/**
	*/
	private function adminRole()
	{
		return Role::where('name',"admin" )->first();
	}
	/**
	*/
	private function savePermissions()
	{
		(new Permission)->generateFor($this->model->getTable());
	}
	/**
	*/
	private function getPermissions()
	{
		return Permission::where('table_name',$this->model->getTable() )->get();
	}


}

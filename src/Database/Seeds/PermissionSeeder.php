<?php namespace vilbur\VoyagerSeeder\Database\Seeds;

use Illuminate\Database\Eloquent\Model;
//use Symfony\Component\Console\Output\ConsoleOutput;

use TCG\Voyager\Models\Role;
use TCG\Voyager\Models\Permission;
//use vilbur\VoyagerSeeder\Models\DataRowColumn;
//use vilbur\VoyagerSeeder\Models\DataRowForeign;
//use vilbur\VoyagerSeeder\Models\DataRowRelated;


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
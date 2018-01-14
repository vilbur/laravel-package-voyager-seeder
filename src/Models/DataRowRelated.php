<?php namespace Vilbur\VoyagerSeeder\Models;

use  vilbur\VoyagerSeeder\Traits\DataRowRelationshipTrait;
/**
 */
class DataRowRelated extends DataRow
{
	use DataRowRelationshipTrait;


    /**
	 * @param Doctrine\DBAL\Schema\ForeignKeyConstraint $foreign_key
     */
    public function fillModel()
	{
		$this->setRelationship( app('\App\\'.$this->getForeignModel()), str_plural($this->getModelName()) );
		return $this;
    }


}

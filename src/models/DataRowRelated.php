<?php namespace Vilbur\VoyagerSeeder\Models;

use  Vilbur\VoyagerSeeder\Traits\DataRowRelationshipTrait;
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
		$this->setRelationship( $this->model->{$this->getForeignModel()}()->getModel(), str_plural($this->getModelName()) );
		return $this;
    }


}

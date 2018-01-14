<?php namespace Vilbur\VoyagerSeeder\Models;

use  vilbur\VoyagerSeeder\Traits\DataRowRelationshipTrait;
/**
 */
class DataRowForeign extends DataRow
{
	use DataRowRelationshipTrait;


    /**
	 * @param Doctrine\DBAL\Schema\ForeignKeyConstraint $foreign_key
     */
    public function fillModel()
	{
		$this->setRelationship( $this->model, $this->getForeignModel() );
		return $this;
    }


}

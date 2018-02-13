<?php namespace Vilbur\VoyagerSeeder\Models;

use  Vilbur\VoyagerSeeder\Traits\DataRowRelationshipTrait;
/** Model for column 'relationships' in table 'data_rows'
 *  Create Voyagers foreign relationship E.G: 'hasMany'
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

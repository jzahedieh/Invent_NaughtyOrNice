<?php
class Invent_NaughtyOrNice_Model_Resource_List extends Mage_Core_Model_Resource_Db_Abstract
{

	/**
	 * Link the resource model to our table and tell it our primary id
	 */
	protected function _construct()
	{
		$this->_init('invent_naughtyornice/list', 'id');
	}

}
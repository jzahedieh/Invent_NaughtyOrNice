<?php
class Invent_NaughtyOrNice_Model_Resource_List_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{

	/**
	 * Initialise the base collection for the list
	 */
	protected function _construct()
	{
		$this->_init('invent_naughtyornice/list');
	}

	public function addRandomSelect() {
		$this->getSelect()
			->order('RAND()') //randomise order
			->limit(1);

		return $this;
	}

	public function addNaughtyFilter() {
		$this->addFieldToFilter('is_naughty', true);

		return $this;
	}

	public function addNiceFilter() {
		$this->addFieldToFilter('is_naughty', false);

		return $this;
	}

}
<?php
class Invent_NaughtyOrNice_Model_List extends Mage_Core_Model_Abstract
{
	/**
	 * Initialise the resource model in order to connect to the database.
	 */
	protected function _construct()
	{
		$this->_init('invent_naughtyornice/list');
	}

	/**
	 * Add random customer to be randomly naughty or nice.
	 *
	 * @return bool
	 */
	public function addRandomCustomer()
	{
		$collection = Mage::getModel('customer/customer')->getCollection();
		$collection->getSelect()
			->order('RAND()') //randomise order
			->limit(1); //limit to one

		if ($collection->getSize()) {
			$customer_id = $collection->getFirstItem()->getId();

			$this->setCustomerId($customer_id)
				->setIsNaughty(mt_rand(0, 1)) //true or false random
				->save();

			return true;
		}

		return false;

	}

	/**
	 * Get a single random nice entry from our table
	 *
	 * @return Varien_Object
	 */
	public function getRandomNiceCustomer()
	{
		/* @var $collection Invent_NaughtyOrNice_Model_Resource_List_Collection */
		$collection = $this->getCollection();

		$collection->addRandomSelect()->addNiceFilter();

		return $collection->getFirstItem();

	}

}
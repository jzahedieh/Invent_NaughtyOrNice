<?php
require_once 'abstract.php';

class HOHOHO extends Mage_Shell_Abstract
{

	public function run()
	{
		$model = Mage::getModel('invent_naughtyornice/list');
		if ($this->getArg('add')) {
			$model->addRandomCustomer();
		} elseif ($this->getArg('get')) {
			$entry = $model->getRandomNiceCustomer();
			if ($entry) {
				echo sprintf('Customer ID (%d) is nice', $entry->getCustomerId()) . PHP_EOL;
			}

		} else {
			echo $this->usageHelp();
		}
	}

}

$shell = new HOHOHO();
$shell->run();

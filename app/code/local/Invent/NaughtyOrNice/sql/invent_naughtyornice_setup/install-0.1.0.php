<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

//get the table name from etc/config.xml
$table = $installer->getTable('invent_naughtyornice/list');

//if the table exists we drop and recreate, useful for development rollbacks.
if ($installer->tableExists($table)) {
	$installer->getConnection()->dropTable($table);
}

/** @var $ddlTable Varien_Db_Ddl_Table */
$ddlTable = $installer->getConnection()->newTable($table);

$ddlTable
	->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
		'primary'  => true, //primary key
		'identity' => true, //auto_increment
		'unsigned' => true, //not a minus number
		'nullable' => false //not null
	), 'id')
	->addColumn('customer_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
		'nullable' => false
	), 'Customer ID')
	->addColumn('is_naughty', Varien_Db_Ddl_Table::TYPE_BOOLEAN, null, array(
		'nullable' => false,
		'default'  => 0 //default to false aka nice
	), 'Is Naughty')
	->addForeignKey( //add a foreign key constraint to the customer
		$installer->getFkName('invent_naughtyornice/list', 'customer_id', 'customer/entity', 'entity_id'),
		'customer_id',
		$installer->getTable('customer/entity'),
		'entity_id',
		Varien_Db_Ddl_Table::ACTION_CASCADE, // CASCADE means if the customer is deleted their record will be deleted.
		Varien_Db_Ddl_Table::ACTION_CASCADE
	)->setComment('Invent Naughty Or Nice');

$installer->getConnection()->createTable($ddlTable);
$installer->endSetup();
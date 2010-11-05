<?php 
/* SVN FILE: $Id$ */
/* Status Fixture generated on: 2009-06-20 02:06:06 : 1245437046*/

class StatusFixture extends CakeTestFixture {
	var $name = 'Status';
	var $table = 'statuses';
	var $fields = array(
		'id' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary'),
		'name' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 100),
		'visible' => array('type'=>'boolean', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $records = array(array(
		'id'  => 'Lorem ipsum dolor sit amet',
		'name'  => 'Lorem ipsum dolor sit amet',
		'visible'  => 1
	));
}
?>
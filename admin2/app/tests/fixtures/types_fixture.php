<?php 
/* SVN FILE: $Id$ */
/* Types Fixture generated on: 2009-06-20 02:06:34 : 1245436234*/

class TypesFixture extends CakeTestFixture {
	var $name = 'Types';
	var $fields = array(
		'id' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary'),
		'name' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 100),
		'visible' => array('type'=>'boolean', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $records = array(array(
		'id'  => 'Lorem ipsum dolor sit amet',
		'name'  => 'Lorem ipsum dolor sit amet',
		'visible'  => 1
	));
}
?>
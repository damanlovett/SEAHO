<?php 
/* SVN FILE: $Id$ */
/* Audience Fixture generated on: 2009-05-23 10:05:52 : 1243044832*/

class AudienceFixture extends CakeTestFixture {
	var $name = 'Audience';
	var $table = 'audiences';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 100),
		'deleted' => array('type'=>'integer', 'null' => false, 'default' => '0', 'length' => 1),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $records = array(array(
		'id'  => 1,
		'name'  => 'Lorem ipsum dolor sit amet',
		'deleted'  => 1
	));
}
?>
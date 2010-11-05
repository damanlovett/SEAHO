<?php 
/* SVN FILE: $Id$ */
/* Topic Fixture generated on: 2009-06-20 02:06:38 : 1245435098*/

class TopicFixture extends CakeTestFixture {
	var $name = 'Topic';
	var $table = 'topics';
	var $fields = array(
		'id' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary'),
		'name' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 36),
		'visible' => array('type'=>'boolean', 'null' => false, 'default' => NULL),
		'indexes' => array()
	);
	var $records = array(array(
		'id'  => 'Lorem ipsum dolor sit amet',
		'name'  => 'Lorem ipsum dolor sit amet',
		'visible'  => 1
	));
}
?>
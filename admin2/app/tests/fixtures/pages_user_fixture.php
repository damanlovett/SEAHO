<?php 
/* SVN FILE: $Id$ */
/* PagesUser Fixture generated on: 2009-07-12 13:07:02 : 1247377442*/

class PagesUserFixture extends CakeTestFixture {
	var $name = 'PagesUser';
	var $table = 'pages_users';
	var $fields = array(
		'page_id' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary'),
		'user_id' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary'),
		'indexes' => array('PRIMARY' => array('column' => array('page_id', 'user_id'), 'unique' => 1))
	);
	var $records = array(array(
		'page_id'  => 'Lorem ipsum dolor sit amet',
		'user_id'  => 'Lorem ipsum dolor sit amet'
	));
}
?>
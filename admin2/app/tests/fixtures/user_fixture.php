<?php 
/* SVN FILE: $Id$ */
/* User Fixture generated on: 2009-07-12 12:07:52 : 1247372932*/

class UserFixture extends CakeTestFixture {
	var $name = 'User';
	var $table = 'users';
	var $fields = array(
		'id' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary'),
		'username' => array('type'=>'string', 'null' => false, 'default' => NULL),
		'password' => array('type'=>'string', 'null' => false, 'default' => NULL),
		'group_id' => array('type'=>'integer', 'null' => false, 'default' => NULL),
		'profile_id' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 36),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $records = array(array(
		'id'  => 'Lorem ipsum dolor sit amet',
		'username'  => 'Lorem ipsum dolor sit amet',
		'password'  => 'Lorem ipsum dolor sit amet',
		'group_id'  => 1,
		'profile_id'  => 'Lorem ipsum dolor sit amet'
	));
}
?>
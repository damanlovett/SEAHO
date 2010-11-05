<?php 
/* SVN FILE: $Id$ */
/* management Fixture generated on: 2009-06-20 04:06:32 : 1245444512*/

class managementFixture extends CakeTestFixture {
	var $name = 'management';
	var $table = 'users';
	var $fields = array(
		'id' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 36, 'key' => 'primary'),
		'first_name' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 100),
		'last_name' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 100),
		'middle' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 100),
		'position' => array('type'=>'string', 'null' => true, 'default' => NULL),
		'title' => array('type'=>'string', 'null' => true, 'default' => NULL),
		'address' => array('type'=>'string', 'null' => true, 'default' => NULL),
		'city' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 100),
		'state' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 10),
		'zip' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 12),
		'school' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 100),
		'email' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 100),
		'password' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 40),
		'group_id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 5),
		'committeepage_id' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 50),
		'active' => array('type'=>'integer', 'null' => false, 'default' => '1', 'length' => 1),
		'created' => array('type'=>'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type'=>'datetime', 'null' => false, 'default' => NULL),
		'deleted' => array('type'=>'boolean', 'null' => false, 'default' => '0'),
		'indexes' => array()
	);
	var $records = array(array(
		'id'  => 'Lorem ipsum dolor sit amet',
		'first_name'  => 'Lorem ipsum dolor sit amet',
		'last_name'  => 'Lorem ipsum dolor sit amet',
		'middle'  => 'Lorem ipsum dolor sit amet',
		'position'  => 'Lorem ipsum dolor sit amet',
		'title'  => 'Lorem ipsum dolor sit amet',
		'address'  => 'Lorem ipsum dolor sit amet',
		'city'  => 'Lorem ipsum dolor sit amet',
		'state'  => 'Lorem ip',
		'zip'  => 'Lorem ipsu',
		'school'  => 'Lorem ipsum dolor sit amet',
		'email'  => 'Lorem ipsum dolor sit amet',
		'password'  => 'Lorem ipsum dolor sit amet',
		'group_id'  => 1,
		'committeepage_id'  => 'Lorem ipsum dolor sit amet',
		'active'  => 1,
		'created'  => '2009-06-20 04:48:32',
		'modified'  => '2009-06-20 04:48:32',
		'deleted'  => 1
	));
}
?>
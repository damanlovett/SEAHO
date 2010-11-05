<?php 
/* SVN FILE: $Id$ */
/* UsersProgram Fixture generated on: 2009-06-20 07:06:54 : 1245452874*/

class UsersProgramFixture extends CakeTestFixture {
	var $name = 'UsersProgram';
	var $table = 'users_programs';
	var $fields = array(
		'id' => array('type'=>'string', 'null' => false, 'length' => 36, 'key' => 'primary'),
		'first_name' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 25),
		'last_name' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 50),
		'username' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 100),
		'password' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 50),
		'access' => array('type'=>'integer', 'null' => true, 'default' => '3', 'length' => 1),
		'delete' => array('type'=>'integer', 'null' => false, 'default' => '0', 'length' => 1),
		'created' => array('type'=>'datetime', 'null' => false, 'default' => NULL),
		'group' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 100),
		'notes' => array('type'=>'text', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $records = array(array(
		'id'  => 'Lorem ipsum dolor sit amet',
		'first_name'  => 'Lorem ipsum dolor sit a',
		'last_name'  => 'Lorem ipsum dolor sit amet',
		'username'  => 'Lorem ipsum dolor sit amet',
		'password'  => 'Lorem ipsum dolor sit amet',
		'access'  => 1,
		'delete'  => 1,
		'created'  => '2009-06-20 07:07:54',
		'group'  => 'Lorem ipsum dolor sit amet',
		'notes'  => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.'
	));
}
?>
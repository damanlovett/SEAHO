<?php 
/* SVN FILE: $Id$ */
/* Midyearreg Fixture generated on: 2009-07-27 11:07:11 : 1248665891*/

class MidyearregFixture extends CakeTestFixture {
	var $name = 'Midyearreg';
	var $table = 'midyearregs';
	var $fields = array(
		'id' => array('type'=>'string', 'null' => false, 'length' => 36, 'key' => 'primary'),
		'first_name' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 50),
		'last_name' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 50),
		'name_tag' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 100),
		'title' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 100),
		'institution' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 100),
		'email' => array('type'=>'string', 'null' => false, 'length' => 100),
		'role_seaho' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 100),
		'cell_phone' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 100),
		'state' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 100),
		'transportation' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 20),
		'airport' => array('type'=>'string', 'null' => true, 'default' => NULL),
		'arrive' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 30),
		'conf_hotel' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 50),
		'dietary' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 100),
		'special' => array('type'=>'text', 'null' => true, 'default' => NULL),
		'created' => array('type'=>'datetime', 'null' => false, 'default' => '0000-00-00 00:00:00'),
		'modified' => array('type'=>'datetime', 'null' => false, 'default' => '0000-00-00 00:00:00'),
		'notes' => array('type'=>'text', 'null' => true, 'default' => NULL),
		'deleted' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 50),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $records = array(array(
		'id'  => 'Lorem ipsum dolor sit amet',
		'first_name'  => 'Lorem ipsum dolor sit amet',
		'last_name'  => 'Lorem ipsum dolor sit amet',
		'name_tag'  => 'Lorem ipsum dolor sit amet',
		'title'  => 'Lorem ipsum dolor sit amet',
		'institution'  => 'Lorem ipsum dolor sit amet',
		'email'  => 'Lorem ipsum dolor sit amet',
		'role_seaho'  => 'Lorem ipsum dolor sit amet',
		'cell_phone'  => 'Lorem ipsum dolor sit amet',
		'state'  => 'Lorem ipsum dolor sit amet',
		'transportation'  => 'Lorem ipsum dolor ',
		'airport'  => 'Lorem ipsum dolor sit amet',
		'arrive'  => 'Lorem ipsum dolor sit amet',
		'conf_hotel'  => 'Lorem ipsum dolor sit amet',
		'dietary'  => 'Lorem ipsum dolor sit amet',
		'special'  => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
		'created'  => '2009-07-27 11:38:11',
		'modified'  => '2009-07-27 11:38:11',
		'notes'  => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
		'deleted'  => 'Lorem ipsum dolor sit amet'
	));
}
?>
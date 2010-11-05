<?php 
/* SVN FILE: $Id$ */
/* Emailrecord Fixture generated on: 2009-05-12 22:05:53 : 1242137993*/

class EmailrecordFixture extends CakeTestFixture {
	var $name = 'Emailrecord_test';
	var $table = 'emailrecords';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'emailID' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 50),
		'title' => array('type'=>'string', 'null' => false, 'default' => 'no subject', 'length' => 50),
		'emailmessage' => array('type'=>'text', 'null' => true, 'default' => NULL),
		'sent_to' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 50),
		'sent_by' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 100),
		'sent_date' => array('type'=>'timestamp', 'null' => false, 'default' => 'CURRENT_TIMESTAMP'),
		'deleted' => array('type'=>'integer', 'null' => false, 'default' => '0', 'length' => 1),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $records = array(array(
		'id'  => 1,
		'emailID'  => 'Lorem ipsum dolor sit amet',
		'title'  => 'Lorem ipsum dolor sit amet',
		'emailmessage'  => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
		'sent_to'  => 'Lorem ipsum dolor sit amet',
		'sent_by'  => 'Lorem ipsum dolor sit amet',
		'sent_date'  => 'Lorem ipsum dolor sit amet',
		'deleted'  => 1
	));
}
?>
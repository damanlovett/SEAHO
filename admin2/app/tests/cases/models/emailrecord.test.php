<?php 
/* SVN FILE: $Id$ */
/* Emailrecord Test cases generated on: 2009-05-12 22:05:00 : 1242138000*/
App::import('Model', 'Emailrecord');

class EmailrecordTestCase extends CakeTestCase {
	var $Emailrecord = null;
	var $fixtures = array('app.emailrecord');

	function startTest() {
		$this->Emailrecord =& ClassRegistry::init('Emailrecord');
	}

	function testEmailrecordInstance() {
		$this->assertTrue(is_a($this->Emailrecord, 'Emailrecord'));
	}

	function testEmailrecordFind() {
		$this->Emailrecord->recursive = -1;
		$results = $this->Emailrecord->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Emailrecord' => array(
			'id'  => 1,
			'emailID'  => 'Lorem ipsum dolor sit amet',
			'title'  => 'Lorem ipsum dolor sit amet',
			'emailmessage'  => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'sent_to'  => 'Lorem ipsum dolor sit amet',
			'sent_by'  => 'Lorem ipsum dolor sit amet',
			'sent_date'  => 'Lorem ipsum dolor sit amet',
			'deleted'  => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>
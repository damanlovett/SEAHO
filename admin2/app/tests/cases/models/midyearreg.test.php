<?php 
/* SVN FILE: $Id$ */
/* Midyearreg Test cases generated on: 2009-07-27 11:07:11 : 1248665891*/
App::import('Model', 'Midyearreg');

class MidyearregTestCase extends CakeTestCase {
	var $Midyearreg = null;
	var $fixtures = array('app.midyearreg');

	function startTest() {
		$this->Midyearreg =& ClassRegistry::init('Midyearreg');
	}

	function testMidyearregInstance() {
		$this->assertTrue(is_a($this->Midyearreg, 'Midyearreg'));
	}

	function testMidyearregFind() {
		$this->Midyearreg->recursive = -1;
		$results = $this->Midyearreg->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Midyearreg' => array(
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
		$this->assertEqual($results, $expected);
	}
}
?>
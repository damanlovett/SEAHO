<?php 
/* SVN FILE: $Id$ */
/* AudiencesProgram Test cases generated on: 2009-06-20 03:06:21 : 1245439401*/
App::import('Model', 'AudiencesProgram');

class AudiencesProgramTestCase extends CakeTestCase {
	var $AudiencesProgram = null;
	var $fixtures = array('app.audiences_program');

	function startTest() {
		$this->AudiencesProgram =& ClassRegistry::init('AudiencesProgram');
	}

	function testAudiencesProgramInstance() {
		$this->assertTrue(is_a($this->AudiencesProgram, 'AudiencesProgram'));
	}

	function testAudiencesProgramFind() {
		$this->AudiencesProgram->recursive = -1;
		$results = $this->AudiencesProgram->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('AudiencesProgram' => array(
			'audience_id'  => 'Lorem ipsum dolor sit amet',
			'program_id'  => 'Lorem ipsum dolor sit amet'
		));
		$this->assertEqual($results, $expected);
	}
}
?>
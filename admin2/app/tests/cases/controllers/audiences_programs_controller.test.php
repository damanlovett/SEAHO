<?php 
/* SVN FILE: $Id$ */
/* AudiencesProgramsController Test cases generated on: 2009-06-20 03:06:12 : 1245439452*/
App::import('Controller', 'AudiencesPrograms');

class TestAudiencesPrograms extends AudiencesProgramsController {
	var $autoRender = false;
}

class AudiencesProgramsControllerTest extends CakeTestCase {
	var $AudiencesPrograms = null;

	function setUp() {
		$this->AudiencesPrograms = new TestAudiencesPrograms();
		$this->AudiencesPrograms->constructClasses();
	}

	function testAudiencesProgramsControllerInstance() {
		$this->assertTrue(is_a($this->AudiencesPrograms, 'AudiencesProgramsController'));
	}

	function tearDown() {
		unset($this->AudiencesPrograms);
	}
}
?>
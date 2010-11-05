<?php 
/* SVN FILE: $Id$ */
/* AudiencesController Test cases generated on: 2009-06-20 02:06:33 : 1245436773*/
App::import('Controller', 'Audiences');

class TestAudiences extends AudiencesController {
	var $autoRender = false;
}

class AudiencesControllerTest extends CakeTestCase {
	var $Audiences = null;

	function setUp() {
		$this->Audiences = new TestAudiences();
		$this->Audiences->constructClasses();
	}

	function testAudiencesControllerInstance() {
		$this->assertTrue(is_a($this->Audiences, 'AudiencesController'));
	}

	function tearDown() {
		unset($this->Audiences);
	}
}
?>
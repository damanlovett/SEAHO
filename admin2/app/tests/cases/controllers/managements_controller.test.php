<?php 
/* SVN FILE: $Id$ */
/* ManagementsController Test cases generated on: 2009-06-20 04:06:10 : 1245444550*/
App::import('Controller', 'Managements');

class TestManagements extends ManagementsController {
	var $autoRender = false;
}

class ManagementsControllerTest extends CakeTestCase {
	var $Managements = null;

	function setUp() {
		$this->Managements = new TestManagements();
		$this->Managements->constructClasses();
	}

	function testManagementsControllerInstance() {
		$this->assertTrue(is_a($this->Managements, 'ManagementsController'));
	}

	function tearDown() {
		unset($this->Managements);
	}
}
?>
<?php 
/* SVN FILE: $Id$ */
/* ProgramsController Test cases generated on: 2009-05-23 09:05:31 : 1243043251*/
App::import('Controller', 'Programs');

class TestPrograms extends ProgramsController {
	var $autoRender = false;
}

class ProgramsControllerTest extends CakeTestCase {
	var $Programs = null;

	function setUp() {
		$this->Programs = new TestPrograms();
		$this->Programs->constructClasses();
	}

	function testProgramsControllerInstance() {
		$this->assertTrue(is_a($this->Programs, 'ProgramsController'));
	}

	function tearDown() {
		unset($this->Programs);
	}
}
?>
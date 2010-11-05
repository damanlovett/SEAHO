<?php 
/* SVN FILE: $Id$ */
/* MidyearregsController Test cases generated on: 2009-07-27 11:07:25 : 1248665965*/
App::import('Controller', 'Midyearregs');

class TestMidyearregs extends MidyearregsController {
	var $autoRender = false;
}

class MidyearregsControllerTest extends CakeTestCase {
	var $Midyearregs = null;

	function setUp() {
		$this->Midyearregs = new TestMidyearregs();
		$this->Midyearregs->constructClasses();
	}

	function testMidyearregsControllerInstance() {
		$this->assertTrue(is_a($this->Midyearregs, 'MidyearregsController'));
	}

	function tearDown() {
		unset($this->Midyearregs);
	}
}
?>
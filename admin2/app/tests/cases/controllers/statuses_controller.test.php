<?php 
/* SVN FILE: $Id$ */
/* StatusesController Test cases generated on: 2009-06-20 02:06:30 : 1245437070*/
App::import('Controller', 'Statuses');

class TestStatuses extends StatusesController {
	var $autoRender = false;
}

class StatusesControllerTest extends CakeTestCase {
	var $Statuses = null;

	function setUp() {
		$this->Statuses = new TestStatuses();
		$this->Statuses->constructClasses();
	}

	function testStatusesControllerInstance() {
		$this->assertTrue(is_a($this->Statuses, 'StatusesController'));
	}

	function tearDown() {
		unset($this->Statuses);
	}
}
?>
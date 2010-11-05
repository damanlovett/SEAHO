<?php 
/* SVN FILE: $Id$ */
/* ActionsController Test cases generated on: 2009-06-23 09:06:36 : 1245721236*/
App::import('Controller', 'Actions');

class TestActions extends ActionsController {
	var $autoRender = false;
}

class ActionsControllerTest extends CakeTestCase {
	var $Actions = null;

	function setUp() {
		$this->Actions = new TestActions();
		$this->Actions->constructClasses();
	}

	function testActionsControllerInstance() {
		$this->assertTrue(is_a($this->Actions, 'ActionsController'));
	}

	function tearDown() {
		unset($this->Actions);
	}
}
?>
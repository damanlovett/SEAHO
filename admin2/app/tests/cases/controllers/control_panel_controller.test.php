<?php 
/* SVN FILE: $Id$ */
/* ControlPanelController Test cases generated on: 2009-06-23 09:06:10 : 1245720790*/
App::import('Controller', 'ControlPanel');

class TestControlPanel extends ControlPanelController {
	var $autoRender = false;
}

class ControlPanelControllerTest extends CakeTestCase {
	var $ControlPanel = null;

	function setUp() {
		$this->ControlPanel = new TestControlPanel();
		$this->ControlPanel->constructClasses();
	}

	function testControlPanelControllerInstance() {
		$this->assertTrue(is_a($this->ControlPanel, 'ControlPanelController'));
	}

	function tearDown() {
		unset($this->ControlPanel);
	}
}
?>
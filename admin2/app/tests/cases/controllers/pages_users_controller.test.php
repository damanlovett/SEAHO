<?php 
/* SVN FILE: $Id$ */
/* PagesUsersController Test cases generated on: 2009-07-12 13:07:38 : 1247377478*/
App::import('Controller', 'PagesUsers');

class TestPagesUsers extends PagesUsersController {
	var $autoRender = false;
}

class PagesUsersControllerTest extends CakeTestCase {
	var $PagesUsers = null;

	function setUp() {
		$this->PagesUsers = new TestPagesUsers();
		$this->PagesUsers->constructClasses();
	}

	function testPagesUsersControllerInstance() {
		$this->assertTrue(is_a($this->PagesUsers, 'PagesUsersController'));
	}

	function tearDown() {
		unset($this->PagesUsers);
	}
}
?>
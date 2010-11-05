<?php 
/* SVN FILE: $Id$ */
/* UsersProgramsController Test cases generated on: 2009-06-20 07:06:46 : 1245453046*/
App::import('Controller', 'UsersPrograms');

class TestUsersPrograms extends UsersProgramsController {
	var $autoRender = false;
}

class UsersProgramsControllerTest extends CakeTestCase {
	var $UsersPrograms = null;

	function setUp() {
		$this->UsersPrograms = new TestUsersPrograms();
		$this->UsersPrograms->constructClasses();
	}

	function testUsersProgramsControllerInstance() {
		$this->assertTrue(is_a($this->UsersPrograms, 'UsersProgramsController'));
	}

	function tearDown() {
		unset($this->UsersPrograms);
	}
}
?>
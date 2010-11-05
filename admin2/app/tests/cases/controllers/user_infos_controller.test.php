<?php 
/* SVN FILE: $Id$ */
/* UserInfosController Test cases generated on: 2009-06-20 06:06:16 : 1245448996*/
App::import('Controller', 'UserInfos');

class TestUserInfos extends UserInfosController {
	var $autoRender = false;
}

class UserInfosControllerTest extends CakeTestCase {
	var $UserInfos = null;

	function setUp() {
		$this->UserInfos = new TestUserInfos();
		$this->UserInfos->constructClasses();
	}

	function testUserInfosControllerInstance() {
		$this->assertTrue(is_a($this->UserInfos, 'UserInfosController'));
	}

	function tearDown() {
		unset($this->UserInfos);
	}
}
?>
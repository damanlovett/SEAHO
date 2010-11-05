<?php 
/* SVN FILE: $Id$ */
/* ProfileController Test cases generated on: 2009-07-12 13:07:49 : 1247375149*/
App::import('Controller', 'Profile');

class TestProfile extends ProfileController {
	var $autoRender = false;
}

class ProfileControllerTest extends CakeTestCase {
	var $Profile = null;

	function setUp() {
		$this->Profile = new TestProfile();
		$this->Profile->constructClasses();
	}

	function testProfileControllerInstance() {
		$this->assertTrue(is_a($this->Profile, 'ProfileController'));
	}

	function tearDown() {
		unset($this->Profile);
	}
}
?>
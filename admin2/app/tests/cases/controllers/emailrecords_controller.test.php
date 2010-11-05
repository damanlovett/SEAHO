<?php 
/* SVN FILE: $Id$ */
/* EmailrecordsController Test cases generated on: 2009-05-12 21:05:29 : 1242136769*/
App::import('Controller', 'Emailrecords');

class TestEmailrecords extends EmailrecordsController {
	var $autoRender = false;
}

class EmailrecordsControllerTest extends CakeTestCase {
	var $Emailrecords = null;

	function setUp() {
		$this->Emailrecords = new TestEmailrecords();
		$this->Emailrecords->constructClasses();
	}

	function testEmailrecordsControllerInstance() {
		$this->assertTrue(is_a($this->Emailrecords, 'EmailrecordsController'));
	}

	function tearDown() {
		unset($this->Emailrecords);
	}
}
?>
<?php 
/* SVN FILE: $Id$ */
/* TopicsController Test cases generated on: 2009-06-20 02:06:45 : 1245435165*/
App::import('Controller', 'Topics');

class TestTopics extends TopicsController {
	var $autoRender = false;
}

class TopicsControllerTest extends CakeTestCase {
	var $Topics = null;

	function setUp() {
		$this->Topics = new TestTopics();
		$this->Topics->constructClasses();
	}

	function testTopicsControllerInstance() {
		$this->assertTrue(is_a($this->Topics, 'TopicsController'));
	}

	function tearDown() {
		unset($this->Topics);
	}
}
?>
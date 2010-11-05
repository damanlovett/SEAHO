<?php 
/* SVN FILE: $Id$ */
/* Topic Test cases generated on: 2009-06-20 02:06:38 : 1245435098*/
App::import('Model', 'Topic');

class TopicTestCase extends CakeTestCase {
	var $Topic = null;
	var $fixtures = array('app.topic');

	function startTest() {
		$this->Topic =& ClassRegistry::init('Topic');
	}

	function testTopicInstance() {
		$this->assertTrue(is_a($this->Topic, 'Topic'));
	}

	function testTopicFind() {
		$this->Topic->recursive = -1;
		$results = $this->Topic->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Topic' => array(
			'id'  => 'Lorem ipsum dolor sit amet',
			'name'  => 'Lorem ipsum dolor sit amet',
			'visible'  => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>
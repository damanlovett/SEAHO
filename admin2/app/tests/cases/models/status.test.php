<?php 
/* SVN FILE: $Id$ */
/* Status Test cases generated on: 2009-06-20 02:06:06 : 1245437046*/
App::import('Model', 'Status');

class StatusTestCase extends CakeTestCase {
	var $Status = null;
	var $fixtures = array('app.status');

	function startTest() {
		$this->Status =& ClassRegistry::init('Status');
	}

	function testStatusInstance() {
		$this->assertTrue(is_a($this->Status, 'Status'));
	}

	function testStatusFind() {
		$this->Status->recursive = -1;
		$results = $this->Status->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Status' => array(
			'id'  => 'Lorem ipsum dolor sit amet',
			'name'  => 'Lorem ipsum dolor sit amet',
			'visible'  => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>
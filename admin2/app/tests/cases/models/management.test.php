<?php 
/* SVN FILE: $Id$ */
/* management Test cases generated on: 2009-06-20 04:06:32 : 1245444512*/
App::import('Model', 'management');

class managementTestCase extends CakeTestCase {
	var $management = null;
	var $fixtures = array('app.management');

	function startTest() {
		$this->management =& ClassRegistry::init('management');
	}

	function testmanagementInstance() {
		$this->assertTrue(is_a($this->management, 'management'));
	}

	function testmanagementFind() {
		$this->management->recursive = -1;
		$results = $this->management->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('management' => array(
			'id'  => 'Lorem ipsum dolor sit amet',
			'first_name'  => 'Lorem ipsum dolor sit amet',
			'last_name'  => 'Lorem ipsum dolor sit amet',
			'middle'  => 'Lorem ipsum dolor sit amet',
			'position'  => 'Lorem ipsum dolor sit amet',
			'title'  => 'Lorem ipsum dolor sit amet',
			'address'  => 'Lorem ipsum dolor sit amet',
			'city'  => 'Lorem ipsum dolor sit amet',
			'state'  => 'Lorem ip',
			'zip'  => 'Lorem ipsu',
			'school'  => 'Lorem ipsum dolor sit amet',
			'email'  => 'Lorem ipsum dolor sit amet',
			'password'  => 'Lorem ipsum dolor sit amet',
			'group_id'  => 1,
			'committeepage_id'  => 'Lorem ipsum dolor sit amet',
			'active'  => 1,
			'created'  => '2009-06-20 04:48:32',
			'modified'  => '2009-06-20 04:48:32',
			'deleted'  => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>
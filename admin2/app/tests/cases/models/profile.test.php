<?php 
/* SVN FILE: $Id$ */
/* Profile Test cases generated on: 2009-07-12 13:07:41 : 1247375621*/
App::import('Model', 'Profile');

class ProfileTestCase extends CakeTestCase {
	var $Profile = null;
	var $fixtures = array('app.profile', 'app.user');

	function startTest() {
		$this->Profile =& ClassRegistry::init('Profile');
	}

	function testProfileInstance() {
		$this->assertTrue(is_a($this->Profile, 'Profile'));
	}

	function testProfileFind() {
		$this->Profile->recursive = -1;
		$results = $this->Profile->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Profile' => array(
			'id'  => 'Lorem ipsum dolor sit amet',
			'user_id'  => 'Lorem ipsum dolor sit amet',
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
			'created'  => '2009-07-12 13:13:39',
			'modified'  => '2009-07-12 13:13:39',
			'deleted'  => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>
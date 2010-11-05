<?php 
/* SVN FILE: $Id$ */
/* UserInfo Test cases generated on: 2009-06-20 06:06:39 : 1245448959*/
App::import('Model', 'UserInfo');

class UserInfoTestCase extends CakeTestCase {
	var $UserInfo = null;
	var $fixtures = array('app.user_info', 'app.group', 'app.committeepage');

	function startTest() {
		$this->UserInfo =& ClassRegistry::init('UserInfo');
	}

	function testUserInfoInstance() {
		$this->assertTrue(is_a($this->UserInfo, 'UserInfo'));
	}

	function testUserInfoFind() {
		$this->UserInfo->recursive = -1;
		$results = $this->UserInfo->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('UserInfo' => array(
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
			'created'  => '2009-06-20 06:02:39',
			'modified'  => '2009-06-20 06:02:39',
			'deleted'  => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>
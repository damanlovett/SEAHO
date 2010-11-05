<?php 
/* SVN FILE: $Id$ */
/* UsersProgram Test cases generated on: 2009-06-20 07:06:54 : 1245452874*/
App::import('Model', 'UsersProgram');

class UsersProgramTestCase extends CakeTestCase {
	var $UsersProgram = null;
	var $fixtures = array('app.users_program');

	function startTest() {
		$this->UsersProgram =& ClassRegistry::init('UsersProgram');
	}

	function testUsersProgramInstance() {
		$this->assertTrue(is_a($this->UsersProgram, 'UsersProgram'));
	}

	function testUsersProgramFind() {
		$this->UsersProgram->recursive = -1;
		$results = $this->UsersProgram->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('UsersProgram' => array(
			'id'  => 'Lorem ipsum dolor sit amet',
			'first_name'  => 'Lorem ipsum dolor sit a',
			'last_name'  => 'Lorem ipsum dolor sit amet',
			'username'  => 'Lorem ipsum dolor sit amet',
			'password'  => 'Lorem ipsum dolor sit amet',
			'access'  => 1,
			'delete'  => 1,
			'created'  => '2009-06-20 07:07:54',
			'group'  => 'Lorem ipsum dolor sit amet',
			'notes'  => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.'
		));
		$this->assertEqual($results, $expected);
	}
}
?>
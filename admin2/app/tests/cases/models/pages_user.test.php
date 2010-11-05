<?php 
/* SVN FILE: $Id$ */
/* PagesUser Test cases generated on: 2009-07-12 13:07:02 : 1247377442*/
App::import('Model', 'PagesUser');

class PagesUserTestCase extends CakeTestCase {
	var $PagesUser = null;
	var $fixtures = array('app.pages_user');

	function startTest() {
		$this->PagesUser =& ClassRegistry::init('PagesUser');
	}

	function testPagesUserInstance() {
		$this->assertTrue(is_a($this->PagesUser, 'PagesUser'));
	}

	function testPagesUserFind() {
		$this->PagesUser->recursive = -1;
		$results = $this->PagesUser->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('PagesUser' => array(
			'page_id'  => 'Lorem ipsum dolor sit amet',
			'user_id'  => 'Lorem ipsum dolor sit amet'
		));
		$this->assertEqual($results, $expected);
	}
}
?>
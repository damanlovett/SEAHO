<?php 
/* SVN FILE: $Id$ */
/* Audience Test cases generated on: 2009-05-23 10:05:52 : 1243044832*/
App::import('Model', 'Audience');

class AudienceTestCase extends CakeTestCase {
	var $Audience = null;
	var $fixtures = array('app.audience');

	function startTest() {
		$this->Audience =& ClassRegistry::init('Audience');
	}

	function testAudienceInstance() {
		$this->assertTrue(is_a($this->Audience, 'Audience'));
	}

	function testAudienceFind() {
		$this->Audience->recursive = -1;
		$results = $this->Audience->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Audience' => array(
			'id'  => 1,
			'name'  => 'Lorem ipsum dolor sit amet',
			'deleted'  => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>
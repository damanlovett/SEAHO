<?php 
/* SVN FILE: $Id$ */
/* Types Test cases generated on: 2009-06-20 02:06:35 : 1245436235*/
App::import('Model', 'Types');

class TypesTestCase extends CakeTestCase {
	var $Types = null;
	var $fixtures = array('app.types');

	function startTest() {
		$this->Types =& ClassRegistry::init('Types');
	}

	function testTypesInstance() {
		$this->assertTrue(is_a($this->Types, 'Types'));
	}

	function testTypesFind() {
		$this->Types->recursive = -1;
		$results = $this->Types->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Types' => array(
			'id'  => 'Lorem ipsum dolor sit amet',
			'name'  => 'Lorem ipsum dolor sit amet',
			'visible'  => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>
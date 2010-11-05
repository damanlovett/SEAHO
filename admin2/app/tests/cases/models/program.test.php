<?php 
/* SVN FILE: $Id$ */
/* Program Test cases generated on: 2009-05-23 09:05:00 : 1243043220*/
App::import('Model', 'Program');

class ProgramTestCase extends CakeTestCase {
	var $Program = null;
	var $fixtures = array('app.program');

	function startTest() {
		$this->Program =& ClassRegistry::init('Program');
	}

	function testProgramInstance() {
		$this->assertTrue(is_a($this->Program, 'Program'));
	}

	function testProgramFind() {
		$this->Program->recursive = -1;
		$results = $this->Program->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Program' => array(
			'id'  => 1,
			'name'  => 'Lorem ipsum dolor sit amet',
			'ProgramNumber'  => 'Lorem ipsum dolor sit amet',
			'session'  => 'Lorem ip',
			'location'  => 'Lorem ipsum dolor sit amet',
			'programTime'  => 'Lorem ipsum dolor sit amet',
			'FirstName'  => 'Lorem ipsum dolor sit a',
			'LastName'  => 'Lorem ipsum dolor sit a',
			'MiddleInitial'  => 'Lor',
			'Title'  => 'Lorem ipsum dolor sit amet',
			'Institution'  => 'Lorem ipsum dolor sit amet',
			'Address'  => 'Lorem ipsum dolor sit amet',
			'City'  => 'Lorem ipsum dolor sit amet',
			'State'  => 'Lorem ipsum dolor sit a',
			'Zip'  => 'Lorem ipsum dolor sit a',
			'PhoneNumber'  => 'Lorem ipsum dolor sit amet',
			'EmailAddress'  => 'Lorem ipsum dolor sit amet',
			'ExperienceLevel'  => 'Lorem ipsum dolor sit amet',
			'addName1'  => 'Lorem ipsum dolor sit amet',
			'addTitle1'  => 'Lorem ipsum dolor sit amet',
			'addInstitution1'  => 'Lorem ipsum dolor sit amet',
			'addName2'  => 'Lorem ipsum dolor sit amet',
			'addTitle2'  => 'Lorem ipsum dolor sit amet',
			'addInstitution2'  => 'Lorem ipsum dolor sit amet',
			'addName3'  => 'Lorem ipsum dolor sit amet',
			'addTitle3'  => 'Lorem ipsum dolor sit amet',
			'addInstitution3'  => 'Lorem ipsum dolor sit amet',
			'SessionType'  => 'Lorem ipsum dolor sit amet',
			'audience_id'  => 1,
			'targetAudience1'  => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'targetAudience2'  => 'Lorem ipsum dolor sit amet',
			'targetAudience3'  => 'Lorem ipsum dolor sit amet',
			'targetAudience4'  => 'Lorem ipsum dolor sit amet',
			'targetAudience5'  => 'Lorem ipsum dolor sit amet',
			'targetAudience6'  => 'Lorem ipsum dolor sit amet',
			'targetAudience7'  => 'Lorem ipsum dolor sit amet',
			'EquipmentNeeds'  => 'Lorem ipsum dolor sit amet',
			'EquipmentNeeds2'  => 'Lorem ipsum dolor sit amet',
			'EquipmentNeedsO'  => 'Lorem ipsum dolor sit amet',
			'SchRequests'  => 'Lor',
			'SchRequestsTitle1'  => 'Lorem ipsum dolor sit amet',
			'SchRequestsPresenter1'  => 'Lorem ipsum dolor sit amet',
			'SchRequestsTitle2'  => 'Lorem ipsum dolor sit amet',
			'SchRequestsPresenter2'  => 'Lorem ipsum dolor sit amet',
			'SchRequestsTitle3'  => 'Lorem ipsum dolor sit amet',
			'SchRequestsPresenter3'  => 'Lorem ipsum dolor sit amet',
			'BestSeaho'  => 'Lor',
			'TopicArea'  => 'Lorem ipsum dolor sit amet',
			'LearningObj1'  => 'Lorem ipsum dolor sit amet',
			'LearningObj2'  => 'Lorem ipsum dolor sit amet',
			'LearningOjb3'  => 'Lorem ipsum dolor sit amet',
			'ProgramDescription'  => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'OutlineOfPresentation'  => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'Notes'  => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'moderated'  => 1,
			'modified'  => '2009-05-23 09:47:00',
			'created'  => '2009-05-23 09:47:00',
			'deleted'  => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>
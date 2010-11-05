<?php
class ProfilesController extends AppController {

	var $name = 'Profiles';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Profile->recursive = 0;
		$this->set('profiles', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Profile', true), array('action'=>'index'));
		}
		$this->set('profile', $this->Profile->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Profile->create();
			if ($this->Profile->save($this->data)) {
				$this->flash(__('Profile saved.', true), array('action'=>'index'));
			} else {
			}
		}
		$users = $this->Profile->User->find('list');
		$this->set(compact('users'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid Profile', true), array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Profile->save($this->data)) {
				$this->flash(__('The Profile has been saved.', true), array('action'=>'index'));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Profile->read(null, $id);
		}
		$users = $this->Profile->User->find('list');
		$this->set(compact('users'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Profile', true), array('action'=>'index'));
		}
		if ($this->Profile->del($id)) {
			$this->flash(__('Profile deleted', true), array('action'=>'index'));
		}
	}

}
?>
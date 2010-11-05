<?php
class MidyearregsController extends AppController {

	var $name = 'Midyearregs';
	var $helpers = array('Html', 'Form', 'Ajax', 'Javascript', 'Session', 'Time');
    var $components = array('Email');
	var $message = null;
    
    function sendemail($id = null){
    	
		$this->set('midyearreg', $this->Midyearreg->read(null, $id));
        $this->message = $midyearreg['first_name'].' is testing the db';
        $this->Email->to = 'eddie@lovettcreations.org';
        $this->Email->subject = 'TODAY Cake test simple email';
        $this->Email->replyTo = 'noreply@localhost';
        $this->Email->from = 'Cake Test Account <noreply@localhost>';
        $this->Email->delivery = 'mail';
        $this->Email->sendAs = 'text';
        //Set the body of the mail as we send it.
        //Note: the text can be an array, each element will appear as a
        //seperate line in the message body.
        if ( $this->Email->send($this->message) ) {
            $this->Session->setFlash('Simple email sent');
        } else {
            $this->Session->setFlash('Simple email not sent');
        }
        $this->redirect('/');
    }
	
function viewActive() {
		$this->pageTitle = 'Mid-year 2009 Registration';
		$this->layout = 'lccm';
		
		
	}

	function index() {
		$this->Midyearreg->recursive = 0;
		$this->set('midyearregs', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Midyearreg.', true));
			$this->redirect(array('action'=>'index'));
		}
            $this->set('midyearregs', $this->Midyearregs->read(null, $id));
            $this->_sendNewUserMail($id);
			$this->redirect('/');

	}

	function add() {
		if (!empty($this->data)) {
			$this->Midyearreg->create();
			if ($this->Midyearreg->save($this->data)) {
				$this->Session->write('name',$this->data[first_name]);
				$this->Session->setFlash(__('Your registration has been entered and will be processed soon.  Thanks for your registration and we\'ll see you in October. You may close this browser window now', 'default'));
				$this->redirect(array('controller'=>'pages', 'action'=>'blue'));
			} else {
				$this->Session->setFlash(__('Your registration could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Midyearreg', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Midyearreg->save($this->data)) {
				$this->Session->setFlash(__('The Midyearreg has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Midyearreg could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Midyearreg->read(null, $id);
		}
	}


function _sendNewUserMail($id) {
        
		$User = $this->Midyearreg->read(null, $id);
        $this->Email->to = 'eddie@lovettcreations.org';
        $this->Email->subject = 'Confirmation Cake test simple email';
        $this->Email->replyTo = 'noreply@localhost';
        $this->Email->from = 'Cake Test Account <noreply@localhost>';
        $this->Email->delivery = 'mail';
        $this->Email->sendAs = 'both';
        $this->Email->template = 'default'; // note no '.ctp'
            //Send as 'html', 'text' or 'both' (default is 'text')
        $this->Email->sendAs = 'both'; // because we like to send pretty mail
           //Set view variables as normal
        $this->set('user', $User);

        
        if ( $this->Email->send() ) {
            $this->Session->setFlash('Simple email sent');
        } else {
            $this->Session->setFlash('Simple email not sent');
        }
		return;
}
//	function delete($id = null) {
//		if (!$id) {
//			$this->Session->setFlash(__('Invalid id for Midyearreg', true));
//			$this->redirect(array('action'=>'index'));
//		}
//		if ($this->Midyearreg->del($id)) {
//			$this->Session->setFlash(__('Midyearreg deleted', true));
//			$this->redirect(array('action'=>'index'));
//		}
//	}


	function admin_index() {
		$this->pageTitle = 'Administration Mid-year 2010 Registration';
		$this->Midyearreg->recursive = 0;
		$this->set('midyearregs', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Midyearreg.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('midyearreg', $this->Midyearreg->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Midyearreg->create();
			if ($this->Midyearreg->save($this->data)) {
				$this->Session->setFlash(__('The Midyearreg has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Midyearreg could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Midyearreg', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Midyearreg->save($this->data)) {
				$this->Session->setFlash(__('The Midyearreg has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Midyearreg could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Midyearreg->read(null, $id);
		}
	}

	function admin_delete($id = null) {
     if (!$id) {
			$this->Session->setFlash(__('Invalid id for Midyearreg', true));
			$this->redirect(array('action'=>'index'));
	}
		if ($this->Midyearreg->del($id)) {
			$this->Session->setFlash(__('Midyearreg deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}
	
function superuser_index() {
		$this->pageTitle = 'Administration Mid-year 2009 Registration';
		$this->Midyearreg->recursive = 0;
		$this->set('midyearregs', $this->paginate());
	}


}
?>
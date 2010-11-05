<?php

    if  ($session->check('Message.auth')) $session->flash('auth');
    echo $form->create('User', array('action' => 'login'));
	echo $form->input('username',array('between'=>'<br>','class'=>'text'));
    echo $form->input('password',array('between'=>'<br>','class'=>'text'));
	echo $form->end('Login');
    
?>
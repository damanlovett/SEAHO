<?php
    echo $form->create('MyFile', array('action' => 'add', 'type' => 'file'));
    echo $form->file('File');
	echo $form->hidden('user_id', array('value'=>'1'));
    echo $form->submit('Upload');
    echo $form->end();
?>


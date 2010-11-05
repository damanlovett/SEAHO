<div class="profiles form">
<?php echo $form->create('Profile');?>
	<fieldset>
 		<legend><?php __('Add Profile');?></legend>
	<?php
		echo $form->input('user_id');
		echo $form->input('first_name');
		echo $form->input('last_name');
		echo $form->input('middle');
		echo $form->input('position');
		echo $form->input('title');
		echo $form->input('address');
		echo $form->input('city');
		echo $form->input('state');
		echo $form->input('zip');
		echo $form->input('school');
		echo $form->input('email');
		echo $form->input('password');
		echo $form->input('group_id');
		echo $form->input('committeepage_id');
		echo $form->input('active');
		echo $form->input('deleted');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Profiles', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Users', true), array('controller'=> 'users', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New User', true), array('controller'=> 'users', 'action'=>'add')); ?> </li>
	</ul>
</div>

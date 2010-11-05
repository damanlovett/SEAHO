<div class="permissions form">
<?php echo $form->create('Permission');?>
	<fieldset>
 		<legend><?php __('Edit Permission');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Permission.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Permission.id'))); ?></li>
		<li><?php echo $html->link(__('List Permissions', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Groups', true), array('controller'=> 'groups', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Group', true), array('controller'=> 'groups', 'action'=>'add')); ?> </li>
	</ul>
</div>
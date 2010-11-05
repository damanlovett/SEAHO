<div class="myFiles form">
<?php echo $form->create('MyFile');?>
	<fieldset>
 		<legend><?php __('Edit MyFile');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('type');
		echo $form->input('size');
		echo $form->input('data');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('MyFile.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('MyFile.id'))); ?></li>
		<li><?php echo $html->link(__('List MyFiles', true), array('action'=>'index'));?></li>
	</ul>
</div>

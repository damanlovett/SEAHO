<div class="midyearregs form">
<?php echo $form->create('Midyearreg');?>
	<fieldset>
 		<legend><?php __('Edit Midyearreg');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('first_name');
		echo $form->input('last_name');
		echo $form->input('name_tag');
		echo $form->input('title');
		echo $form->input('institution');
		echo $form->input('email');
		echo $form->input('role_seaho');
		echo $form->input('cell_phone');
		echo $form->input('state');
		echo $form->input('transportation');
		echo $form->input('airport');
		echo $form->input('arrive');
		echo $form->input('conf_hotel');
		echo $form->input('dietary');
		echo $form->input('special');
		echo $form->input('notes');
		echo $form->input('deleted');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Midyearreg.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Midyearreg.id'))); ?></li>
		<li><?php echo $html->link(__('List Midyearregs', true), array('action'=>'index'));?></li>
	</ul>
</div>

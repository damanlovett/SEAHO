<div class="pagesUsers form">
<?php echo $form->create('PagesUser');?>
	<fieldset>
 		<legend><?php __('Edit PagesUser');?></legend>
	<?php
		echo $form->input('page_id');
		echo $form->input('user_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('PagesUser.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('PagesUser.id'))); ?></li>
		<li><?php echo $html->link(__('List PagesUsers', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Pages', true), array('controller'=> 'pages', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Page', true), array('controller'=> 'pages', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Users', true), array('controller'=> 'users', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New User', true), array('controller'=> 'users', 'action'=>'add')); ?> </li>
	</ul>
</div>

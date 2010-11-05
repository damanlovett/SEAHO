<div class="pagesUsers view">
<h2><?php  __('PagesUser');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Page'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($pagesUser['Page']['name'], array('controller'=> 'pages', 'action'=>'view', $pagesUser['Page']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($pagesUser['User']['id'], array('controller'=> 'users', 'action'=>'view', $pagesUser['User']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit PagesUser', true), array('action'=>'edit', $pagesUser['PagesUser']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete PagesUser', true), array('action'=>'delete', $pagesUser['PagesUser']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $pagesUser['PagesUser']['id'])); ?> </li>
		<li><?php echo $html->link(__('List PagesUsers', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New PagesUser', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Pages', true), array('controller'=> 'pages', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Page', true), array('controller'=> 'pages', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Users', true), array('controller'=> 'users', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New User', true), array('controller'=> 'users', 'action'=>'add')); ?> </li>
	</ul>
</div>

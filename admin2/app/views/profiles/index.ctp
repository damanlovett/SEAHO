<div class="profiles index">
<h2><?php __('Profiles');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('user_id');?></th>
	<th><?php echo $paginator->sort('first_name');?></th>
	<th><?php echo $paginator->sort('last_name');?></th>
	<th><?php echo $paginator->sort('middle');?></th>
	<th><?php echo $paginator->sort('position');?></th>
	<th><?php echo $paginator->sort('title');?></th>
	<th><?php echo $paginator->sort('address');?></th>
	<th><?php echo $paginator->sort('city');?></th>
	<th><?php echo $paginator->sort('state');?></th>
	<th><?php echo $paginator->sort('zip');?></th>
	<th><?php echo $paginator->sort('school');?></th>
	<th><?php echo $paginator->sort('email');?></th>
	<th><?php echo $paginator->sort('password');?></th>
	<th><?php echo $paginator->sort('group_id');?></th>
	<th><?php echo $paginator->sort('committeepage_id');?></th>
	<th><?php echo $paginator->sort('active');?></th>
	<th><?php echo $paginator->sort('created');?></th>
	<th><?php echo $paginator->sort('modified');?></th>
	<th><?php echo $paginator->sort('deleted');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($profiles as $profile):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $profile['Profile']['id']; ?>
		</td>
		<td>
			<?php echo $html->link($profile['User']['id'], array('controller'=> 'users', 'action'=>'view', $profile['User']['id'])); ?>
		</td>
		<td>
			<?php echo $profile['Profile']['first_name']; ?>
		</td>
		<td>
			<?php echo $profile['Profile']['last_name']; ?>
		</td>
		<td>
			<?php echo $profile['Profile']['middle']; ?>
		</td>
		<td>
			<?php echo $profile['Profile']['position']; ?>
		</td>
		<td>
			<?php echo $profile['Profile']['title']; ?>
		</td>
		<td>
			<?php echo $profile['Profile']['address']; ?>
		</td>
		<td>
			<?php echo $profile['Profile']['city']; ?>
		</td>
		<td>
			<?php echo $profile['Profile']['state']; ?>
		</td>
		<td>
			<?php echo $profile['Profile']['zip']; ?>
		</td>
		<td>
			<?php echo $profile['Profile']['school']; ?>
		</td>
		<td>
			<?php echo $profile['Profile']['email']; ?>
		</td>
		<td>
			<?php echo $profile['Profile']['password']; ?>
		</td>
		<td>
			<?php echo $profile['Profile']['group_id']; ?>
		</td>
		<td>
			<?php echo $profile['Profile']['committeepage_id']; ?>
		</td>
		<td>
			<?php echo $profile['Profile']['active']; ?>
		</td>
		<td>
			<?php echo $profile['Profile']['created']; ?>
		</td>
		<td>
			<?php echo $profile['Profile']['modified']; ?>
		</td>
		<td>
			<?php echo $profile['Profile']['deleted']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $profile['Profile']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $profile['Profile']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $profile['Profile']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $profile['Profile']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('New Profile', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('List Users', true), array('controller'=> 'users', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New User', true), array('controller'=> 'users', 'action'=>'add')); ?> </li>
	</ul>
</div>

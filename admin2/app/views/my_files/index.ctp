<div class="myFiles index">
<h2><?php __('MyFiles');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('name');?></th>
	<th><?php echo $paginator->sort('type');?></th>
	<th><?php echo $paginator->sort('size');?></th>
	<th><?php echo $paginator->sort('data');?></th>
	<th><?php echo $paginator->sort('created');?></th>
	<th><?php echo $paginator->sort('modified');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($myFiles as $myFile):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $myFile['MyFile']['id']; ?>
		</td>
		<td>
			<?php echo $myFile['MyFile']['name']; ?>
		</td>
		<td>
			<?php echo $myFile['MyFile']['type']; ?>
		</td>
		<td>
			<?php echo $myFile['MyFile']['size']; ?>
		</td>
		<td>
			<?php echo $myFile['MyFile']['data']; ?>
		</td>
		<td>
			<?php echo $myFile['MyFile']['created']; ?>
		</td>
		<td>
			<?php echo $myFile['MyFile']['modified']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $myFile['MyFile']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $myFile['MyFile']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $myFile['MyFile']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $myFile['MyFile']['id'])); ?>
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
		<li><?php echo $html->link(__('New MyFile', true), array('action'=>'add')); ?></li>
	</ul>
</div>

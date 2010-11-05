<div class="midyearregs index">
<h2><?php __('Midyearregs');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('first_name');?></th>
	<th><?php echo $paginator->sort('last_name');?></th>
	<th><?php echo $paginator->sort('name_tag');?></th>
	<th><?php echo $paginator->sort('institution');?></th>
	<th><?php echo $paginator->sort('email');?></th>
	<th><?php echo $paginator->sort('created');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($midyearregs as $midyearreg):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $midyearreg['Midyearreg']['first_name']; ?>
		</td>
		<td>
			<?php echo $midyearreg['Midyearreg']['last_name']; ?>
		</td>
		<td>
			<?php echo $midyearreg['Midyearreg']['name_tag']; ?>
		</td>
		<td>
			<?php echo $midyearreg['Midyearreg']['institution']; ?>
		</td>
		<td>
			<?php echo $midyearreg['Midyearreg']['email']; ?>
		</td>
		<td>
			<?php echo $time->format('m/d/y h:i a', $midyearreg['Midyearreg']['created']); ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $midyearreg['Midyearreg']['id'])); ?>
			<?php //echo $html->link(__('Edit', true), array('action'=>'edit', $midyearreg['Midyearreg']['id'])); ?>
			<?php //echo $html->link(__('Delete', true), array('action'=>'delete', $midyearreg['Midyearreg']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $midyearreg['Midyearreg']['id'])); ?>
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
		<li><?php echo $html->link(__('New Midyearreg', true), array('action'=>'add')); ?></li>
	</ul>
</div>

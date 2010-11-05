<div class="midyearregs index">
<h2><?php __('Mid-Year Registrations');?></h2>
<p>
<div class="pageNav"><?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?>
</div></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th nowrap><?php echo $paginator->sort('Member','last_name');?></th>
	<th nowrap><?php echo $paginator->sort('name_tag');?></th>
	<th nowrap><?php echo $paginator->sort('title');?></th>
	<th nowrap><?php echo $paginator->sort('institution');?></th>
	<th nowrap><?php echo $paginator->sort('email');?></th>
	<th nowrap><?php echo $paginator->sort('airport');?></th>
	<th nowrap><?php echo $paginator->sort('arrive');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($midyearregs as $midyearreg):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
	$fullname = $midyearreg['Midyearreg']['last_name'].", ".$midyearreg['Midyearreg']['first_name'];
?>
	<tr<?php echo $class;?>>
		<td nowrap>
			<?php echo $html->link(__($fullname, true), array('action'=>'view', $midyearreg['Midyearreg']['id'])); ?>
		</td>

		<td>
			<?php echo $midyearreg['Midyearreg']['name_tag']; ?>&nbsp;
		</td>
		<td>
			<?php echo $midyearreg['Midyearreg']['title']; ?>&nbsp;
		</td>
		<td>
			<?php echo $midyearreg['Midyearreg']['institution']; ?>&nbsp;
		</td>
		<td>
			<?php echo $midyearreg['Midyearreg']['email']; ?>&nbsp;
		</td>
		<td>
			<?php echo $midyearreg['Midyearreg']['airport']; ?>&nbsp;
		</td>
		<td>
			<?php echo $midyearreg['Midyearreg']['arrive']; ?>&nbsp;
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

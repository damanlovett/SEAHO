<div style="width:90%; padding:0px; color:#fff; background-color:#165FA3; border:1px solid #165FA3;"> 
	<h1 style="font-size:2em; color:#fff; background-color:#165FA3; margin:0px; padding:0 0 0 15px; line-height:2em; border:1px solid #ccc;">2010 Seaho Mid-Year Meeting</h1>
</div>
<div class="midyearregs form" style="color:#165FA3; font-size:1em; ">
<?php echo $form->create('Midyearreg');?>
	<fieldset>
 		<legend style="color:#165FA3;"><?php __('Registration');?></legend>
		
		<?php //options for selects
		$transportation=array('N/A'=>'-----', 'Fly'=>'Fly','Drive'=>'Drive');
		$airport=array('N/A'=>'-----', 
					  	'Mobile, AL (MOB)'=>'Mobile, AL (MOB)', 
	   				'Gulfport, MS (GPT)'=>'Gulfport, MS (GPT)', 
						'Pensacola, FL (PNS)'=>'Pensacola, FL (PNS)',
						'New Orleans, LA (MSY)'=>'New Orleans, LA (MSY)');
		$arrival=array('N/A'=>'-----', 
						'Sun'=>'Sunday, October 17',
						'Mon'=>'Monday, October 18',
						'Tue'=>'Tuesday,October 19',
						'Other'=>'Other');
		$stay=array('N/A'=>'-----',
						'Y'=>'Yes',
						'N'=>'No');
		$state=array('N/A'=>'-----', 
						'AL'=>'AL',
						'FL'=>'FL',
						'GA'=>'GA',
						'KY'=>'KY', 
						'LA'=>'LA', 
						'MS'=>'MS', 
						'NC'=>'NC', 
						'SC'=>'SC', 
						'TN'=>'TN', 
						'VA'=>'VA');			
		?>
		
	<?php
		echo $form->input('first_name');
		echo $form->input('last_name');
		echo $form->input('name_tag');
		echo $form->input('title');
		echo $form->input('institution');
		echo $form->input('email',array('class'=>'required'));
		echo $form->input('role_seaho', array('label'=>'Position or Role in SEAHO?'));
		echo $form->input('cell_phone');
		
		e($form->label('state','State'));
		echo $form->select('state',$state, array('selected'=>'N/A'));
		
		echo $form->label('transportation','Will you fly or drive to SEAHO Mid-year in Mobile, Alabama?');
		echo $form->select('transportation',$transportation, array('selected'=>'N/A'));
		
		echo $form->label('airport','If flying, into which airport?');
		echo $form->select('airport',$airport, array('selected'=>'N/A'));
		
		echo $form->label('arrive','When do you anticipate arriving for Mid-year?');
		echo $form->select('arrive',$arrival, array('selected'=>'N/A'));
		
		echo $form->label('conf_hotel','Do you plan to stay in the conference hotel ($175/night)?');
		echo $form->select('conf_hotel',$stay, array('selected'=>'N/A'));
		echo $form->input('dietary', array('label'=>'Do you have any special dietary needs or requests? (Any food allergies?)'));
		echo $form->input('special', array('label'=>'Do you have any need or request for special accommodations?'));
	?>
	</fieldset>
<?php echo $form->end('Submit Registration');?>
</div>
<!-- <div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Midyearregs', true), array('action'=>'index'));?></li>
	</ul>
</div> -->

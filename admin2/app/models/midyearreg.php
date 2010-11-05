<?php
class Midyearreg extends AppModel {

	var $name = 'Midyearreg';
	var $useDbConfig = 'cms';
	var $validate = array(
		'email' => array('email')
	);

}
?>
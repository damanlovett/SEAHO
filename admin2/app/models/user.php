<?php
class User extends AppModel {

	var $name = 'User';
	var $useDbConfig = 'cms';
	var $validate = array(
        'username' => array('email'),
        'password' => array('alphaNumeric'),
        'active' => array('numeric')
    );
    var $hasAndBelongsToMany = array(
            'Group' => array('className' => 'Group',
                        'joinTable' => 'groups_users',
                        'foreignKey' => 'user_id',
                        'associationForeignKey' => 'group_id',
                        'unique' => true
            )
    );
}
?>
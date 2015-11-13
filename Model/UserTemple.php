<?php

class UserTemple extends AppModel {

	public $belongsTo = array(
		'User' => array(
			'className'  => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields'     => '',
            'order'      => ''
		),
		'Temple' => array(
			'className'  => 'Temple',
            'foreignKey' => 'temple_id',
            'conditions' => '',
            'fields'     => '',
            'order'      => ''
		)
	);
	
	public $validate = array(
		'user_id' => array(
			'rule' => 'notBlank',
		),
		'temple_id'=> array(
			'rule'=>'notBlank',
		)
	);


}

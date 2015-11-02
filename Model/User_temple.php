<?php

class User_temple extends AppModel {

	public $belongsTo = array('User','Temple');
	
	public $validate = array(
		'user_id' => array(
			'rule' => 'notBlank',
		),
		'temple_id'=> array(
			'rule'=>'notBlank',
		)
	);


}

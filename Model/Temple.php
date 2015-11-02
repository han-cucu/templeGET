<?php

class Temple extends AppModel {
	public $hasAndBelongsToMany = array(
		'User' =>
			array(
				'className'              => 'user',
      			'joinTable'              => 'user_temples',
      			'foreignKey'             => 'temple_id',
      			'associationForeignKey'  => 'user_id',
      			'unique'                 => true
      			)
    );
	public $validate = array(
		'name' => array(
			'rule' => 'notBlank',
			'message' => '空ではだめです'
		),
		'body'=> array(
			'rule'=>'notBlank',
		)
	);


}

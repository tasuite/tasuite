<?php
class Student extends AppModel {
    public $validate = array(
	'compid' => array(
		'rule' => 'notEmpty'
	),
	'fname' => array(
		'rule' => 'notEmpty'
	),
	'lname' => array(
		'rule' => 'notEmpty'
	),
	'role' => array(
		'rule' => 'notEmpty'
	),
	'title' => array(
		'rule' => 'notEmpty'
	),
	'body' => array(
		'rule' => 'notEmpty'
	),
	'id' => array(
		'rule' => 'notEmpty'
	),   
    );
}


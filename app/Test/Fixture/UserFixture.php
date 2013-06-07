<?php
/**
 * UserFixture
 *
 */
class UserFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'email' => array('type' => 'string', 'null' => false, 'length' => 100),
		'password' => array('type' => 'string', 'null' => false, 'length' => 50),
		'nome' => array('type' => 'string', 'null' => false, 'length' => 200),
		'sobrenome' => array('type' => 'string', 'null' => false, 'length' => 200),
		'img_foto' => array('type' => 'string', 'null' => true, 'length' => 200),
		'holding_id' => array('type' => 'integer', 'null' => false),
		'ultimoacesso' => array('type' => 'datetime', 'null' => true),
		'created' => array('type' => 'datetime', 'null' => true),
		'modified' => array('type' => 'datetime', 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id'),
			'user_email' => array('unique' => true, 'column' => 'email')
		),
		'tableParameters' => array()
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'email' => 'Lorem ipsum dolor sit amet',
			'password' => 'Lorem ipsum dolor sit amet',
			'nome' => 'Lorem ipsum dolor sit amet',
			'sobrenome' => 'Lorem ipsum dolor sit amet',
			'img_foto' => 'Lorem ipsum dolor sit amet',
			'holding_id' => 1,
			'ultimoacesso' => '2013-06-06 15:00:27',
			'created' => '2013-06-06 15:00:27',
			'modified' => '2013-06-06 15:00:27'
		),
	);

}

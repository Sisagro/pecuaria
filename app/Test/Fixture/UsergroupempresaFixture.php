<?php
/**
 * UsergroupempresaFixture
 *
 */
class UsergroupempresaFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false),
		'empresa_id' => array('type' => 'integer', 'null' => false),
		'group_id' => array('type' => 'integer', 'null' => false),
		'empresaboot' => array('type' => 'integer', 'null' => false),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id'),
			'usergroupempresas_user_empresa_key' => array('unique' => true, 'column' => array('user_id', 'empresa_id'))
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
			'user_id' => 1,
			'empresa_id' => 1,
			'group_id' => 1,
			'empresaboot' => 1
		),
	);

}

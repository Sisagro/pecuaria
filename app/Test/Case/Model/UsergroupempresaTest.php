<?php
App::uses('Usergroupempresa', 'Model');

/**
 * Usergroupempresa Test Case
 *
 */
class UsergroupempresaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.usergroupempresa',
		'app.user',
		'app.holding',
		'app.empresa',
		'app.userempresa',
		'app.group',
		'app.groupmenu'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Usergroupempresa = ClassRegistry::init('Usergroupempresa');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Usergroupempresa);

		parent::tearDown();
	}

}

<?php
App::uses('Operateur', 'Model');

/**
 * Operateur Test Case
 *
 */
class OperateurTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.operateur'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Operateur = ClassRegistry::init('Operateur');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Operateur);

		parent::tearDown();
	}

}

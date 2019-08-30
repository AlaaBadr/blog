<?php
App::uses('Role', 'Model');

/**
 * Role Test Case
 */
class RoleTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.role',
		'app.user',
		'app.comment',
		'app.post'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Role = ClassRegistry::init('Role');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Role);

		parent::tearDown();
	}

    public function testGetAllRoles() {
        $data = $this->Role->getAllRoles();

        $expected = array(
            array(
                'id' => 1,
                'name' => 'admin',
            ),
            array(
                'id' => 2,
                'name' => 'author',
            ),
        );

        $result = Hash::extract($data, '{n}.Role');

        $this->assertEquals($expected, $result);
    }

    public function testAddRole() {
        $postData = array('name' => 'testing role');

        $numRecordsBefore = $this->Role->find('count');
        $data = $this->Role->addRole($postData);
        $result = $data['Role'];
        $numRecordsAfter = $this->Role->find('count');

        $expected = array(
            'id' => 3,
            'name' => 'testing role',
        );

        $this->assertEquals(3, $numRecordsAfter);
        $this->assertTrue($numRecordsBefore != $numRecordsAfter);
        $this->assertEquals($expected, $result);
    }
}

<?php
App::uses('User', 'Model');

/**
 * User Test Case
 */
class UserTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.user',
		'app.role',
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
		$this->User = ClassRegistry::init('User');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->User);

		parent::tearDown();
	}

    public function testGetAllUsers() {
        $data = $this->User->getAllUsers();

        $expected = array(
            array(
                'id' => 1,
                'full_name' => 'Lorem ipsum dolor sit amet 1',
                'username' => 'lorem_ipsum1',
                'password' => 'loremipsum1',
                'email' => 'lorem.ipsum1@dolor.sit',
                'phone_number' => '01111111111',
                'role_id' => 1,
                'created_at' => '2019-04-14 19:29:40',
                'updated_at' => '2019-04-14 19:29:40',
            ),
            array(
                'id' => 2,
                'full_name' => 'Lorem ipsum dolor sit amet 2',
                'username' => 'lorem_ipsum2',
                'password' => 'loremipsum2',
                'email' => 'lorem.ipsum2@dolor.sit',
                'phone_number' => '01222222222',
                'role_id' => 2,
                'created_at' => '2019-04-14 19:29:40',
                'updated_at' => '2019-04-14 19:29:40',
            ),
        );

        $result = Hash::extract($data, '{n}.User');

        $this->assertEquals($expected, $result);
    }

    public function testGetSingleUser()
    {
        $data = $this->User->getSingleUser(2);

        $expected = array(
            'id' => 2,
            'full_name' => 'Lorem ipsum dolor sit amet 2',
            'username' => 'lorem_ipsum2',
            'password' => 'loremipsum2',
            'email' => 'lorem.ipsum2@dolor.sit',
            'phone_number' => '01222222222',
            'role_id' => 2,
            'created_at' => '2019-04-14 19:29:40',
            'updated_at' => '2019-04-14 19:29:40',
        );

        $result = $data['User'];

        $this->assertEquals($expected, $result);
    }

    public function testAddUser() {
        $postData = array(
            'full_name' => 'Test User',
            'username' => 'test_user',
            'password' => 'testuser',
            'email' => 'test.user@gmail.com',
            'phone_number' => '01333333333',
            'role_id' => 2,
            'created_at' => '2019-04-14 19:29:40',
            'updated_at' => '2019-04-14 19:29:40',
        );

        $numRecordsBefore = $this->User->find('count');
        $data = $this->User->addUser($postData);
        $result = $data['User'];
        $numRecordsAfter = $this->User->find('count');

        $expected = array(
            'id' => 3,
            'full_name' => 'Test User',
            'username' => 'test_user',
            'password' => 'testuser',
            'email' => 'test.user@gmail.com',
            'phone_number' => '01333333333',
            'role_id' => 2,
            'created_at' => '2019-04-14 19:29:40',
            'updated_at' => '2019-04-14 19:29:40',
        );

        $this->assertEquals(3, $numRecordsAfter);
        $this->assertTrue($numRecordsBefore != $numRecordsAfter);
        $this->assertEquals($expected, $result);
    }

    public function testEditUser() {
        $this->User->id = 1;
        $postData = array(
            'full_name' => 'Lorem ipsum dolor sit amet 1 updated',
            'username' => 'lorem_ipsum1',
            'password' => 'loremipsum1',
            'email' => 'lorem.ipsum1@dolor.sit',
            'phone_number' => '01111111111',
            'role_id' => 1,
            'created_at' => '2019-04-14 19:29:40',
            'updated_at' => '2019-08-30 19:29:40',
        );

        $recordBeforeEdit = $this->User->read();
        $numRecordsBefore = $this->User->find('count');
        $data = $this->User->editUser($postData);
        $result = $data['User'];
        $numRecordsAfter = $this->User->find('count');

        $expected = array(
            'id' => 1,
            'full_name' => 'Lorem ipsum dolor sit amet 1 updated',
            'username' => 'lorem_ipsum1',
            'password' => 'loremipsum1',
            'email' => 'lorem.ipsum1@dolor.sit',
            'phone_number' => '01111111111',
            'role_id' => 1,
            'created_at' => '2019-04-14 19:29:40',
            'updated_at' => '2019-08-30 19:29:40',
        );

        $this->assertEquals($expected, $result);
        $this->assertTrue($numRecordsBefore == $numRecordsAfter);

        $recordCompare = array_diff($recordBeforeEdit['User'], $result);
        $expectedArrayDiffResult = array(
            'full_name' => 'Lorem ipsum dolor sit amet 1',
        );

        $this->assertEquals($expectedArrayDiffResult, $recordCompare);
    }
}

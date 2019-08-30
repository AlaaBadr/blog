<?php
/**
 * User Fixture
 */
class UserFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'full_name' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'username' => array('type' => 'string', 'null' => false, 'default' => null, 'key' => 'unique', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'password' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'email' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'phone_number' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'role_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'created_at' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'updated_at' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'users_username_uindex' => array('column' => 'username', 'unique' => 1),
			'users_roles_id_fk' => array('column' => 'role_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
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

}

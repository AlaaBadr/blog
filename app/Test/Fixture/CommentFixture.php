<?php
/**
 * Comment Fixture
 */
class CommentFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'body' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'post_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'created_at' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'updated_at' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'comments_users_id_fk' => array('column' => 'user_id', 'unique' => 0),
			'comments_posts_id_fk' => array('column' => 'post_id', 'unique' => 0)
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
			'body' => 'This is the very first test',
			'user_id' => 1,
			'post_id' => 1,
			'created_at' => '2019-04-14 19:29:40',
			'updated_at' => '2019-04-14 19:29:40',
		),
        array(
            'id' => 2,
            'body' => 'This is a testing comment',
            'user_id' => 1,
            'post_id' => 2,
            'created_at' => '2019-04-14 19:29:40',
            'updated_at' => '2019-04-14 19:29:40',
        ),
        array(
            'id' => 3,
            'body' => 'very nice post, keep it up',
            'user_id' => 2,
            'post_id' => 3,
            'created_at' => '2019-04-14 19:29:40',
            'updated_at' => '2019-04-14 19:29:40',
        ),
	);

}

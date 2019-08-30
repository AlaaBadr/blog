<?php
App::uses('Post', 'Model');

/**
 * Post Test Case
 */
class PostTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.post',
		'app.user',
		'app.role',
		'app.comment'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Post = ClassRegistry::init('Post');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Post);

		parent::tearDown();
	}

    public function testGetAllPosts() {
        $data = $this->Post->getAllPosts();

        $expected = array(
            array(
                'id' => 1,
                'user_id' => 1,
                'title' => 'Lorem ipsum dolor sit amet',
                'body' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'created_at' => '2019-04-14 19:29:40',
                'updated_at' => '2019-04-14 19:29:40'
            ),
            array(
                'id' => 2,
                'user_id' => 1,
                'title' => 'Lorem ipsum dolor sit amet',
                'body' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'created_at' => '2019-06-09 19:29:40',
                'updated_at' => '2019-06-09 19:29:40'
            ),
            array(
                'id' => 3,
                'user_id' => 2,
                'title' => 'Lorem ipsum dolor sit amet',
                'body' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'created_at' => '2019-02-26 19:29:40',
                'updated_at' => '2019-02-26 19:29:40'
            )
        );

        $result = Hash::extract($data, '{n}.Post');

        $this->assertEquals($expected, $result);
    }

    public function testGetSinglePost()
    {
        $data = $this->Post->getSinglePost(2);

        $expected = array(
            'id' => 2,
            'user_id' => 1,
            'title' => 'Lorem ipsum dolor sit amet',
            'body' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'created_at' => '2019-06-09 19:29:40',
            'updated_at' => '2019-06-09 19:29:40'
        );

        $result = $data['Post'];

        $this->assertEquals($expected, $result);
    }

    public function testAddPost() {
        $postData = array(
            'user_id' => 1,
            'title' => 'Testing Post Title',
            'body' => 'Testing Post Body, using TDD Unit testing',
            'created' => '2019-06-09 19:29:40',
            'updated' => '2019-06-09 19:29:40'
        );

        $numRecordsBefore = $this->Post->find('count');
        $data = $this->Post->addPost($postData);
        $result = $data['Post'];
        $numRecordsAfter = $this->Post->find('count');

        $expected = array(
            'id' => 4,
            'user_id' => 1,
            'title' => 'Testing Post Title',
            'body' => 'Testing Post Body, using TDD Unit testing',
            'created' => '2019-06-09 19:29:40',
            'updated' => '2019-06-09 19:29:40'
        );

        $this->assertEquals(4, $numRecordsAfter);
        $this->assertTrue($numRecordsBefore != $numRecordsAfter);
        $this->assertEquals($expected, $result);
    }

    public function testEditPost() {
        $this->Post->id = 3;
        $postData = array(
            'user_id' => 2,
            'title' => 'Lorem ipsum dolor sit amet, Updated',
            'body' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'created_at' => '2019-02-26 19:29:40',
            'updated_at' => '2019-08-30 19:29:40',
        );

        $recordBeforeEdit = $this->Post->read();
        $numRecordsBefore = $this->Post->find('count');
        $data = $this->Post->editPost($postData);
        $result = $data['Post'];
        $numRecordsAfter = $this->Post->find('count');

        $expected = array(
            'id' => 3,
            'user_id' => 2,
            'title' => 'Lorem ipsum dolor sit amet, Updated',
            'body' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'created_at' => '2019-02-26 19:29:40',
            'updated_at' => '2019-08-30 19:29:40',
        );

        $this->assertEquals($expected, $result);
        $this->assertTrue($numRecordsBefore == $numRecordsAfter);

        $recordCompare = array_diff($recordBeforeEdit['Post'], $result);
        $expectedArrayDiffResult = array(
            'title' => 'Lorem ipsum dolor sit amet',
        );

        $this->assertEquals($expectedArrayDiffResult, $recordCompare);
    }

    public function testDeletePost() {
        $this->Post->id = 2;

        $success = $this->Post->deletePost();

        $this->assertTrue($success);
    }
}

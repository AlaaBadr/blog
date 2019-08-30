<?php
App::uses('Comment', 'Model');

/**
 * Comment Test Case
 */
class CommentTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.comment',
		'app.user',
		'app.role',
		'app.post'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Comment = ClassRegistry::init('Comment');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Comment);

		parent::tearDown();
	}

    public function testAddComment() {
        $postData = array(
            'id' => 4,
            'body' => 'Great, always write these motivating posts',
            'user_id' => 1,
            'post_id' => 1,
            'created_at' => '2019-04-14 19:29:40',
            'updated_at' => '2019-04-14 19:29:40'
        );

        $numRecordsBefore = $this->Comment->find('count');
        $data = $this->Comment->addComment($postData);
        $result = $data['Comment'];
        $numRecordsAfter = $this->Comment->find('count');

        $expected = array(
            'id' => 4,
            'body' => 'Great, always write these motivating posts',
            'user_id' => 1,
            'post_id' => 1,
            'created_at' => '2019-04-14 19:29:40',
            'updated_at' => '2019-04-14 19:29:40'
        );

        $this->assertEquals(4, $numRecordsAfter);
        $this->assertTrue($numRecordsBefore != $numRecordsAfter);
        $this->assertEquals($expected, $result);
    }

    public function testEditComment() {
        $this->Comment->id = 3;
        $postData = array(
            'id' => 3,
            'body' => 'very nice post, keep it up, updated',
            'user_id' => 2,
            'post_id' => 3,
            'created_at' => '2019-04-14 19:29:40',
            'updated_at' => '2019-08-30 19:29:40',
        );

        $recordBeforeEdit = $this->Comment->read();
        $numRecordsBefore = $this->Comment->find('count');
        $data = $this->Comment->editComment($postData);
        $result = $data['Comment'];
        $numRecordsAfter = $this->Comment->find('count');

        $expected = array(
            'id' => 3,
            'body' => 'very nice post, keep it up, updated',
            'user_id' => 2,
            'post_id' => 3,
            'created_at' => '2019-04-14 19:29:40',
            'updated_at' => '2019-08-30 19:29:40',
        );

        $this->assertEquals($expected, $result);
        $this->assertTrue($numRecordsBefore == $numRecordsAfter);

        $recordCompare = array_diff($recordBeforeEdit['Comment'], $result);
        $expectedArrayDiffResult = array(
            'body' => 'very nice post, keep it up',
        );

        $this->assertEquals($expectedArrayDiffResult, $recordCompare);
    }

    public function testDeleteComment() {
        $this->Comment->id = 2;

        $success = $this->Comment->deleteComment();

        $this->assertTrue($success);
    }
}

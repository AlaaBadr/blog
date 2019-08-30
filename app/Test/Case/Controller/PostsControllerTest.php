<?php
App::uses('PostsController', 'Controller');

/**
 * UsersController Test Case
 */
class PostsControllerTest extends ControllerTestCase {

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
     * testIndex method
     *
     * @return void
     */
    public function testIndex() {
        $this->testAction('/posts/index');
        $this->assertInternalType('array', $this->vars['posts']);
        $expected = array(
            'id' => 2,
            'user_id' => 1,
            'title' => 'Lorem ipsum dolor sit amet',
            'body' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'created_at' => '2019-06-09 19:29:40',
            'updated_at' => '2019-06-09 19:29:40'
        );
        $data = Hash::extract($this->vars['posts'], '{n}.Post[id=2]');

        $result = $data[0];

        $this->assertEquals($expected, $result);
    }

    /**
     * testView method
     *
     * @return void
     */
    public function testView() {
        $this->testAction('/posts/view/3');
        $this->assertInternalType('array', $this->vars['post']);
        $expected = array(
            'id' => 3,
            'user_id' => 2,
            'title' => 'Lorem ipsum dolor sit amet',
            'body' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'created_at' => '2019-02-26 19:29:40',
            'updated_at' => '2019-02-26 19:29:40'
        );
        $this->assertEquals($expected, $this->vars['post']['Post']);
    }
}

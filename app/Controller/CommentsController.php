<?php
/**
 * Created by PhpStorm.
 * User: Alaa
 * Date: 8/29/2019
 * Time: 12:20 AM
 */

App::uses('AppController', 'Controller');

class CommentsController extends AppController
{
    public function add($id) {
        if ($this->request->is('post')) {
            $data = array(
                'Comment' =>
                    array_merge(
                        $this->request->data['Comment'],
                        array('user_id' => AuthComponent::user('id'), 'post_id' => $id)
                    )
            );
            $this->Comment->create();
            if ($this->Comment->addComment($data)) {
                $this->Flash->success('The Comment has been added!');
                $this->redirect(
                    array(
                        'controller' => 'posts',
                        'action' => 'view',
                        $id,
                    )
                );
            }
        }
    }

    public function edit($id) {
        $data = $this->Comment->findById($id);

        $comment = $this->Comment->findById($id);

        if ($this->request->is(array('post', 'put'))) {
            $this->Comment->id = $id;
            if ($this->Comment->editComment($this->request->data)) {
                $this->Flash->success('The comment has been edited!');
                $this->redirect(
                    array(
                        'controller' => 'posts',
                        'action' => 'view',
                        $comment['Comment']['post_id'],
                    )
                );
            }
        }

        $this->request->data = $data;
    }

    public function delete($id) {
        $this->Comment->id = $id;

        $comment = $this->Comment->findById($id);

        if ($this->request->is(array('post', 'put'))) {
            if ($this->Comment->delete()) {
                $this->Flash->success('The Comment has been deleted!');
                $this->redirect(
                    array(
                        'controller' => 'posts',
                        'action' => 'view',
                        $comment['Comment']['post_id'],
                    )
                );
            }
        }
    }
}
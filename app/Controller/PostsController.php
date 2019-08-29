<?php
/**
 * Created by PhpStorm.
 * User: Alaa
 * Date: 8/28/2019
 * Time: 10:00 PM
 */

App::uses('AppController', 'Controller');

class PostsController extends AppController {

    public function beforeFilter() {
        $this->Auth->allow('index');
    }

    public function add() {
        if ($this->request->is('post')) {
            $data = array(
                'Post' =>
                    array_merge($this->request->data['Post'], array('user_id' => 1))
            );
            $this->Post->create();
            if ($this->Post->save($data)) {
                $this->Flash->success('The Post has been created!');
                $this->redirect('index');
            }
        }
    }

    public function index() {
        $data = $this->Post->find('all');

        $this->set('posts', $data);
    }

    public function view($id) {
        $data = $this->Post->findById($id);

        $this->set('post', $data);
    }

    public function edit($id) {
        $data = $this->Post->findById($id);

        if ($this->request->is(array('post', 'put'))) {
            $this->Post->id = $id;
            if ($this->Post->save($this->request->data)) {
                $this->Flash->success('The Post has been edited!');
                $this->redirect('index');
            }
        }

        $this->request->data = $data;
    }

    public function delete($id) {
        $this->Post->id = $id;

        if ($this->request->is(array('post', 'put'))) {
            if ($this->Post->delete()) {
                $this->Flash->success('The Post has been deleted!');
                $this->redirect('index');
            }
        }
    }
}
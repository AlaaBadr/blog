<?php
/**
 * Created by PhpStorm.
 * User: Alaa
 * Date: 8/29/2019
 * Time: 7:15 PM
 */

App::uses('AppController', 'Controller');

class RolesController extends AppController {

    public function add(){
        if ($this->request->is('post')) {
            $this->Role->create();
            if ($this->Role->save($this->request->data)) {
                $this->Flash->success('The Role has been added!');
                $this->redirect('index');
            }
        }
    }

    public function index() {
        $data = $this->Role->find('all');

        $this->set('roles', $data);
    }
}
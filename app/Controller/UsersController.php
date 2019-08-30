<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

	public function beforeFilter() {
	    $this->Auth->allow('add');
    }

/**
 * login method
 *
 * @return void
 */
	public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Flash->error('Invalid Username or Password!');
            }
        }
    }

/**
 * logout method
 *
 * @return void
 */
    public function logout() {
        $this->Auth->logout();
        $this->redirect('/posts/index');
    }

    public function getUsernameById($id) {
        $data = $this->User->findById($id);

        return $data['User']['username'];
    }

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
//	public function view($id = null) {
//		if (!$this->User->exists($id)) {
//			throw new NotFoundException(__('Invalid user'));
//		}
//		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
//		$this->set('user', $this->User->find('first', $options));
//	}
    public function view($id) {
        $data = $this->User->findById($id);

        $this->set('user', $data);
    }

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
            $this->request->data['User']['password'] = AuthComponent::password($this->request->data['User']['password']);
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
			}
		}
		$roles = $this->User->Role->find('list');
		$this->set(compact('roles'));
	}

	public function changePassword($id) {
        $data = $this->User->findById($id);

        if ($this->request->is(array('post', 'put'))) {
            if (AuthComponent::password($this->request->data['User']['oldPassword']) == $data['User']['password']) {
                if ($this->request->data['User']['newPassword'] == $this->request->data['User']['passwordConfirmation']) {
                    $this->User->id = $id;
                    $this->request->data['User']['password'] = AuthComponent::password($this->request->data['User']['newPassword']);
                    if ($this->User->save($this->request->data)) {
                        $this->Flash->success('Profile Information has been updated!');
                        $this->redirect(
                            array(
                                'controller' => 'users',
                                'action' => 'view',
                                $id
                            )
                        );
                    }
                } else {
                    $this->Flash->error('Passwords do not match');
                }
            } else {
                $this->Flash->error('Invalid Password, please enter valid one!');
            }
        }
    }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */

    public function edit($id) {
        $data = $this->User->findById($id);

        if ($this->request->is(array('post', 'put'))) {
            $this->User->id = $id;
            if ($this->User->save($this->request->data)) {
                $this->Flash->success('Profile Information has been updated!');
                $this->redirect(
                    array(
                        'controller' => 'users',
                        'action' => 'view',
                        $id
                    )
                );
            }
        }

        $this->request->data = $data;

        $roles = $this->User->Role->find('list');
        $this->set(compact('roles'));
    }
//	public function edit($id = null) {
//		if (!$this->User->exists($id)) {
//			throw new NotFoundException(__('Invalid user'));
//		}
//		if ($this->request->is(array('post', 'put'))) {
//			if ($this->User->save($this->request->data)) {
//				$this->Flash->success(__('The user has been saved.'));
//				return $this->redirect(array('action' => 'index'));
//			} else {
//				$this->Flash->error(__('The user could not be saved. Please, try again.'));
//			}
//		} else {
//			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
//			$this->request->data = $this->User->find('first', $options);
//		}
//		$roles = $this->User->Role->find('list');
//		$this->set(compact('roles'));
//	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->User->delete($id)) {
			$this->Flash->success(__('The user has been deleted.'));
		} else {
			$this->Flash->error(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}

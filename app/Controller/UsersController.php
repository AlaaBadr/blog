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
     * get username using id method
     *
     * @return string
     */
    public function getUsernameById($id) {
        $data = $this->User->getSingleUser($id);

        return $data['User']['username'];
    }

    /**
     * login method
     *
     * @return void
     */
	public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->redirect('/posts/index');
            } else {
                $this->Flash->error('Invalid Username or Password!');
            }
        }
    }

    /**
     * change password method
     *
     * @return CakeResponse|null
     * @throws Exception
     */
    public function changePassword($id) {
        $data = $this->User->findById($id);

        if ($this->request->is(array('post', 'put'))) {
            if (AuthComponent::password($this->request->data['User']['oldPassword']) == $data['User']['password']) {
                if ($this->request->data['User']['newPassword'] == $this->request->data['User']['passwordConfirmation']) {
                    $this->User->id = $id;
                    $this->request->data['User']['password'] = AuthComponent::password($this->request->data['User']['newPassword']);
                    if ($this->User->editUser($this->request->data)) {
                        $this->Flash->success('Password is changed successfully');
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
     * logout method
     *
     * @return void
     */
    public function logout() {
        $this->Auth->logout();
        $this->redirect('/posts/index');
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
    public function view($id) {
        $data = $this->User->getSingleUser($id);

        $this->set('user', $data);
    }

    /**
     * add method
     *
     * @return CakeResponse|null
     * @throws Exception
     */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
            $this->request->data['User']['password'] = AuthComponent::password($this->request->data['User']['password']);
			if ($this->User->addUser($this->request->data)) {
				$this->Flash->success(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
			}
		}
		$roles = $this->User->Role->find('list');
		$this->set(compact('roles'));
	}

    /**
     * edit method
     *
     * @param string $id
     * @return void
     * @throws Exception
     */
    public function edit($id) {
        $data = $this->User->findById($id);

        if ($this->request->is(array('post', 'put'))) {
            $this->User->id = $id;
            if ($this->User->editUser($this->request->data)) {
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
    }
}

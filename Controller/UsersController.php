<?php

class UsersController extends AppController {
	public $components = array("Flash");

    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Flash->set(__('The user has been saved'));
                $this->redirect(array('action' => 'login'));
            } else {
                $this->Flash->set(__('The user could not be saved. Please, try again.'));
            }
        }
    }

	public function beforeFilter() {
    	parent::beforeFilter();//親(Appcontroller)をふまえた上
    	// ユーザー自身による登録とログアウトを許可する
    	$this->Auth->allow('add','logout');
	}
  
	public function login() {
    	if ($this->request->is('post')) {
        	if ($this->Auth->login()) {
            	$this->redirect($this->Auth->redirect());
        	} else {
            	$this->Flash->set(__('Invalid username or password, try again'));
        	}
    	}
}

    public function logout() {
        $this->redirect($this->Auth->logout());
    }


    public function index() {
        $this->User->recursive = 0; 
        $this->set('users', $this->paginate());  

    }


    public function view($id = null) {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->findById($id));
    }

    
    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Flash->set(__('The user has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->set(__('The user could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->User->findById($id);
            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {
        $this->request->onlyAllow('post');

        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Flash->set(__('User deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Flash->set(__('User was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

}


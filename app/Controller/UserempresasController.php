<?php
App::uses('AppController', 'Controller');
/**
 * Userempresas Controller
 *
 * @property Userempresa $Userempresa
 */
class UserempresasController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Userempresa->recursive = 0;
		$this->set('userempresas', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Userempresa->id = $id;
		if (!$this->Userempresa->exists()) {
			throw new NotFoundException(__('Invalid userempresa'));
		}
		$this->set('userempresa', $this->Userempresa->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Userempresa->create();
			if ($this->Userempresa->save($this->request->data)) {
				$this->Session->setFlash(__('The userempresa has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The userempresa could not be saved. Please, try again.'));
			}
		}
		$users = $this->Userempresa->User->find('list');
		$empresas = $this->Userempresa->Empresa->find('list');
		$groups = $this->Userempresa->Group->find('list');
		$this->set(compact('users', 'empresas', 'groups'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Userempresa->id = $id;
		if (!$this->Userempresa->exists()) {
			throw new NotFoundException(__('Invalid userempresa'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Userempresa->save($this->request->data)) {
				$this->Session->setFlash(__('The userempresa has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The userempresa could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Userempresa->read(null, $id);
		}
		$users = $this->Userempresa->User->find('list');
		$empresas = $this->Userempresa->Empresa->find('list');
		$groups = $this->Userempresa->Group->find('list');
		$this->set(compact('users', 'empresas', 'groups'));
	}

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Userempresa->id = $id;
		if (!$this->Userempresa->exists()) {
			throw new NotFoundException(__('Invalid userempresa'));
		}
		if ($this->Userempresa->delete()) {
			$this->Session->setFlash(__('Userempresa deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Userempresa was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}

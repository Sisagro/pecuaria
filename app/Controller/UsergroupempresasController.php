<?php
App::uses('AppController', 'Controller');
/**
 * Usergroupempresas Controller
 *
 * @property Usergroupempresa $Usergroupempresa
 */
class UsergroupempresasController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Usergroupempresa->recursive = 0;
		$this->set('usergroupempresas', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Usergroupempresa->exists($id)) {
			throw new NotFoundException(__('Invalid usergroupempresa'));
		}
		$options = array('conditions' => array('Usergroupempresa.' . $this->Usergroupempresa->primaryKey => $id));
		$this->set('usergroupempresa', $this->Usergroupempresa->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Usergroupempresa->create();
			if ($this->Usergroupempresa->save($this->request->data)) {
				$this->Session->setFlash(__('The usergroupempresa has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The usergroupempresa could not be saved. Please, try again.'));
			}
		}
		$users = $this->Usergroupempresa->User->find('list');
		$empresas = $this->Usergroupempresa->Empresa->find('list');
		$groups = $this->Usergroupempresa->Group->find('list');
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
		if (!$this->Usergroupempresa->exists($id)) {
			throw new NotFoundException(__('Invalid usergroupempresa'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Usergroupempresa->save($this->request->data)) {
				$this->Session->setFlash(__('The usergroupempresa has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The usergroupempresa could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Usergroupempresa.' . $this->Usergroupempresa->primaryKey => $id));
			$this->request->data = $this->Usergroupempresa->find('first', $options);
		}
		$users = $this->Usergroupempresa->User->find('list');
		$empresas = $this->Usergroupempresa->Empresa->find('list');
		$groups = $this->Usergroupempresa->Group->find('list');
		$this->set(compact('users', 'empresas', 'groups'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Usergroupempresa->id = $id;
		if (!$this->Usergroupempresa->exists()) {
			throw new NotFoundException(__('Invalid usergroupempresa'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Usergroupempresa->delete()) {
			$this->Session->setFlash(__('Usergroupempresa deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Usergroupempresa was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}

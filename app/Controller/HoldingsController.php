<?php
App::uses('AppController', 'Controller');
/**
 * Holdings Controller
 *
 * @property Holding $Holding
 */
class HoldingsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Holding->recursive = 0;
		$this->set('holdings', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Holding->id = $id;
		if (!$this->Holding->exists()) {
			throw new NotFoundException(__('Invalid holding'));
		}
		$this->set('holding', $this->Holding->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Holding->create();
			if ($this->Holding->save($this->request->data)) {
				$this->Session->setFlash(__('The holding has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The holding could not be saved. Please, try again.'));
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
	public function edit($id = null) {
		$this->Holding->id = $id;
		if (!$this->Holding->exists()) {
			throw new NotFoundException(__('Invalid holding'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Holding->save($this->request->data)) {
				$this->Session->setFlash(__('The holding has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The holding could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Holding->read(null, $id);
		}
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
		$this->Holding->id = $id;
		if (!$this->Holding->exists()) {
			throw new NotFoundException(__('Invalid holding'));
		}
		if ($this->Holding->delete()) {
			$this->Session->setFlash(__('Holding deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Holding was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}

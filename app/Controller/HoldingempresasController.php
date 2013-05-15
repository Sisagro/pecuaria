<?php
App::uses('AppController', 'Controller');
/**
 * Holdingempresas Controller
 *
 * @property Holdingempresa $Holdingempresa
 */
class HoldingempresasController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Holdingempresa->recursive = 0;
		$this->set('holdingempresas', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Holdingempresa->id = $id;
		if (!$this->Holdingempresa->exists()) {
			throw new NotFoundException(__('Invalid holdingempresa'));
		}
		$this->set('holdingempresa', $this->Holdingempresa->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Holdingempresa->create();
			if ($this->Holdingempresa->save($this->request->data)) {
				$this->Session->setFlash(__('The holdingempresa has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The holdingempresa could not be saved. Please, try again.'));
			}
		}
		$holdings = $this->Holdingempresa->Holding->find('list');
		$empresas = $this->Holdingempresa->Empresa->find('list');
		$this->set(compact('holdings', 'empresas'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Holdingempresa->id = $id;
		if (!$this->Holdingempresa->exists()) {
			throw new NotFoundException(__('Invalid holdingempresa'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Holdingempresa->save($this->request->data)) {
				$this->Session->setFlash(__('The holdingempresa has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The holdingempresa could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Holdingempresa->read(null, $id);
		}
		$holdings = $this->Holdingempresa->Holding->find('list');
		$empresas = $this->Holdingempresa->Empresa->find('list');
		$this->set(compact('holdings', 'empresas'));
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
		$this->Holdingempresa->id = $id;
		if (!$this->Holdingempresa->exists()) {
			throw new NotFoundException(__('Invalid holdingempresa'));
		}
		if ($this->Holdingempresa->delete()) {
			$this->Session->setFlash(__('Holdingempresa deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Holdingempresa was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}

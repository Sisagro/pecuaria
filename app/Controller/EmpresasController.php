<?php

App::uses('AppController', 'Controller');

/**
 * Empresas Controller
 *
 * @property Empresa $Empresa
 */
class EmpresasController extends AppController {

    function beforeFilter() {
        $this->set('title_for_layout', 'Empresas');
    }

    public $paginate = array(
        'order' => array('razaosocial' => 'asc')
    );

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Empresa->recursive = 0;
        $this->set('empresas', $this->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Empresa->exists($id)) {
            throw new NotFoundException(__('Invalid empresa'));
        }
        $options = array('conditions' => array('Empresa.' . $this->Empresa->primaryKey => $id));
        $this->set('empresa', $this->Empresa->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Empresa->create();
            if ($this->Empresa->save($this->request->data)) {
                $this->Session->setFlash(__('The empresa has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The empresa could not be saved. Please, try again.'));
            }
        }
        $holdings = $this->Empresa->Holding->find('list');
        $this->set(compact('holdings'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Empresa->exists($id)) {
            throw new NotFoundException(__('Invalid empresa'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Empresa->save($this->request->data)) {
                $this->Session->setFlash(__('The empresa has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The empresa could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Empresa.' . $this->Empresa->primaryKey => $id));
            $this->request->data = $this->Empresa->find('first', $options);
        }
        $holdings = $this->Empresa->Holding->find('list');
        $this->set(compact('holdings'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Empresa->id = $id;
        if (!$this->Empresa->exists()) {
            throw new NotFoundException(__('Invalid empresa'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Empresa->delete()) {
            $this->Session->setFlash(__('Empresa deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Empresa was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

}

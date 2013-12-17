<?php
App::uses('AppController', 'Controller');

App::import('Controller', 'Users');

/**
 * Pais Controller
 */
class PaisesController extends AppController {
    
    function beforeFilter() {
        $this->set('title_for_layout', 'Países');
    }
    
    public function isAuthorized($user) {
        $Users = new UsersController;
        return $Users->validaAcesso($this->Session->read(), $this->request->controller);
        return parent::isAuthorized($user);
    }
    
    public $components = array('Paginator');
    
    /**
     * index method
     */
    public function index() {
        $dadosUser = $this->Session->read();
        $this->Paise->recursive = 0;
        $this->Paginator->settings = array(
            'conditions' => array('holding_id' => $dadosUser['Auth']['User']['holding_id']),
            'order' => array('nome' => 'asc')
        );
        $this->set('paises', $this->Paginator->paginate('Paise'));
    }

    /**
     * view method
     */
    public function view($id = null) {
        
        if (!$this->Paise->exists($id)) {
            throw new NotFoundException(__('País inválido'));
        }
        $options = array('conditions' => array('Paise.' . $this->Paise->primaryKey => $id));
        $this->set('paise', $this->Paise->find('first', $options));
        
    }

    /**
     * add method
     */
    public function add() {
        
        $dadosUser = $this->Session->read();
        $holding_id = $dadosUser['Auth']['User']['Holding']['id'];
        $this->set(compact('holding_id'));
        
        if ($this->request->is('post')) {
            $this->Paise->create();
            if ($this->Paise->save($this->request->data)) {
                $this->Session->setFlash('País adicionado com sucesso!', 'default', array('class' => 'mensagem_sucesso'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Registro não foi salvo. Por favor tente novamente.', 'default', array('class' => 'mensagem_erro'));
            }
        }
        
    }

    /**
     * edit method
     */
    public function edit($id = null) {
        
        $this->Paise->id = $id;
        if (!$this->Paise->exists($id)) {
            throw new NotFoundException(__('País inválido'));
        }
        
        $dadosUser = $this->Session->read();
        $holding_id = $dadosUser['Auth']['User']['Holding']['id'];
        
        $pais = $this->Paise->read(null, $id);
        if ($pais['Paise']['holding_id'] != $holding_id) {
            throw new NotFoundException(__('País inválida'));
        }
        
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Paise->save($this->request->data)) {
                $this->Session->setFlash('País alterado com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Registro não foi alterado. Por favor tente novamente.', 'default', array('class' => 'mensagem_erro'));
            }
        } else {
            $this->request->data = $this->Paise->read(null, $id);
        }
        
    }

    /**
     * delete method
     */
    public function delete($id = null) {
        
        $this->Paise->id = $id;
        if (!$this->Paise->exists()) {
            throw new NotFoundException(__('País inválido'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Paise->delete()) {
            $this->Session->setFlash('País deletado com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash('Registro não foi deletado.', 'default', array('class' => 'mensagem_erro'));
        $this->redirect(array('action' => 'index'));
        
    }

}
<?php
App::uses('AppController', 'Controller');

App::import('Controller', 'Users');

/**
 * Menus Controller
 */
class EspeciesController extends AppController {
    
    function beforeFilter() {
        $this->set('title_for_layout', 'Espécies');
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
        $this->Especie->recursive = 0;
        $this->Paginator->settings = array(
            'conditions' => array('holding_id' => $dadosUser['Auth']['User']['holding_id']),
            'order' => array('descricao' => 'asc')
        );
        $this->set('especies', $this->Paginator->paginate('Especie'));
    }

    /**
     * view method
     */
    public function view($id = null) {
        
        if (!$this->Especie->exists($id)) {
            throw new NotFoundException(__('Espécie inválida'));
        }
        $options = array('conditions' => array('Especie.' . $this->Especie->primaryKey => $id));
        $this->set('especie', $this->Especie->find('first', $options));     
    }

    /**
     * add method
     */
    public function add() {
        
        $dadosUser = $this->Session->read();
        $holding_id = $dadosUser['Auth']['User']['Holding']['id'];
        $this->set(compact('holding_id'));
        
        if ($this->request->is('post')) {
            $this->Especie->create();
            if ($this->Especie->save($this->request->data)) {
                $this->Session->setFlash('Espécie adicionada com sucesso!', 'default', array('class' => 'mensagem_sucesso'));
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
        
        $this->Especie->id = $id;
        if (!$this->Especie->exists($id)) {
            throw new NotFoundException(__('Espécie inválida'));
        }
        
        $dadosUser = $this->Session->read();
        $holding_id = $dadosUser['Auth']['User']['Holding']['id'];
        
        $especie = $this->Especie->read(null, $id);
        if ($especie['Especie']['holding_id'] != $holding_id) {
            throw new NotFoundException(__('Espécie inválida'));
        }
        
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Especie->save($this->request->data)) {
                $this->Session->setFlash('Espécie alterada com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Registro não foi alterado. Por favor tente novamente.', 'default', array('class' => 'mensagem_erro'));
            }
        } else {
            $this->request->data = $this->Especie->read(null, $id);
        }
        
    }

    /**
     * delete method
     */
    public function delete($id = null) {
        
        $this->Especie->id = $id;
        if (!$this->Especie->exists()) {
            throw new NotFoundException(__('Espécie inválida'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Especie->delete()) {
            $this->Session->setFlash('Espécie deletada com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash('Registro não foi deletado.', 'default', array('class' => 'mensagem_erro'));
        $this->redirect(array('action' => 'index'));
        
    }

}

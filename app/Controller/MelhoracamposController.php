<?php
App::uses('AppController', 'Controller');

App::import('Controller', 'Users');

/**
 * Menus Controller
 */
class MelhoracamposController extends AppController {
    
    function beforeFilter() {
        $this->set('title_for_layout', 'Melhora campo');
    }
    
    public function isAuthorized($user) {
        $Users = new UsersController;
        return $Users->validaAcesso($this->Session->read(), $this->request->controller);
        return parent::isAuthorized($user);
    }
    
    /**
     * index method
     */
    public function index() {
        $dadosUser = $this->Session->read();
        $this->Melhoracampo->recursive = 0;
        $this->Paginator->settings = array(
            'conditions' => array('holding_id' => $dadosUser['Auth']['User']['holding_id']),
            'order' => array('descricao' => 'asc')
        );
        $this->set('melhoracampos', $this->Paginator->paginate('Melhoracampo'));
    }

    /**
     * view method
     */
    public function view($id = null) {
        
        $this->Melhoracampo->id = $id;
        if (!$this->Melhoracampo->exists()) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $dadosUser = $this->Session->read();
        $holding_id = $dadosUser['Auth']['User']['Holding']['id'];
        
        $melhoracampo = $this->Melhoracampo->read(null, $id);
        if ($melhoracampo['Melhoracampo']['holding_id'] != $holding_id) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $this->set('melhoracampo', $melhoracampo);
        
    }

    /**
     * add method
     */
    public function add() {
        
        $dadosUser = $this->Session->read();
        $holding_id = $dadosUser['Auth']['User']['Holding']['id'];
        $this->set(compact('holding_id'));
        
        if ($this->request->is('post')) {
            $this->Melhoracampo->create();
            if ($this->Melhoracampo->save($this->request->data)) {
                $this->Session->setFlash('Melhoramento de campo adicionado com sucesso!', 'default', array('class' => 'mensagem_sucesso'));
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
        
        $this->Melhoracampo->id = $id;
        if (!$this->Melhoracampo->exists()) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $dadosUser = $this->Session->read();
        $holding_id = $dadosUser['Auth']['User']['Holding']['id'];
        
        $melhoracampo = $this->Melhoracampo->read(null, $id);
        if ($melhoracampo['Melhoracampo']['holding_id'] != $holding_id) {
            throw new NotFoundException(__('Melhoramento de campo inválido'));
        }
        
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Melhoracampo->save($this->request->data)) {
                $this->Session->setFlash('Melhoramento de campo alterado com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Registro não foi alterado. Por favor tente novamente.', 'default', array('class' => 'mensagem_erro'));
            }
        } else {
            $this->request->data = $melhoracampo;
        }
        
    }

    /**
     * delete method
     */
    public function delete($id = null) {
        
        $this->Melhoracampo->id = $id;
        if (!$this->Melhoracampo->exists()) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Melhoracampo->delete()) {
            $this->Session->setFlash('Melhoramento de campo deletado com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash('Registro não foi deletado.', 'default', array('class' => 'mensagem_erro'));
        $this->redirect(array('action' => 'index'));
        
    }

}
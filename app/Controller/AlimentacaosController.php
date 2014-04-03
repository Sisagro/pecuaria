<?php
App::uses('AppController', 'Controller');

App::import('Controller', 'Users');

/**
 * Menus Controller
 */
class AlimentacaosController extends AppController {
    
    function beforeFilter() {
        $this->set('title_for_layout', 'Alimentação');
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
        $this->Alimentacao->recursive = 0;
        $this->Paginator->settings = array(
            'conditions' => array('holding_id' => $dadosUser['Auth']['User']['holding_id']),
            'order' => array('descricao' => 'asc')
        );
        $this->set('alimentacaos', $this->Paginator->paginate('Alimentacao'));
    }

    /**
     * view method
     */
    public function view($id = null) {
        
        $this->Alimentacao->id = $id;
        if (!$this->Alimentacao->exists()) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $dadosUser = $this->Session->read();
        $holding_id = $dadosUser['Auth']['User']['Holding']['id'];
        
        $alimentacao = $this->Alimentacao->read(null, $id);
        if ($alimentacao['Alimentacao']['holding_id'] != $holding_id) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $this->set('alimentacao', $alimentacao);
        
    }

    /**
     * add method
     */
    public function add() {
        
        $dadosUser = $this->Session->read();
        $holding_id = $dadosUser['Auth']['User']['Holding']['id'];
        $this->set(compact('holding_id'));
        
        if ($this->request->is('post')) {
            $this->Alimentacao->create();
            if ($this->Alimentacao->save($this->request->data)) {
                $this->Session->setFlash('Alimentação adicionada com sucesso!', 'default', array('class' => 'mensagem_sucesso'));
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
        
        $this->Alimentacao->id = $id;
        if (!$this->Alimentacao->exists()) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $dadosUser = $this->Session->read();
        $holding_id = $dadosUser['Auth']['User']['Holding']['id'];
        
        $alimentacao = $this->Alimentacao->read(null, $id);
        if ($alimentacao['Alimentacao']['holding_id'] != $holding_id) {
            throw new NotFoundException(__('Alimentação inválida'));
        }
        
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Alimentacao->save($this->request->data)) {
                $this->Session->setFlash('Alimentação alterada com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Registro não foi alterado. Por favor tente novamente.', 'default', array('class' => 'mensagem_erro'));
            }
        } else {
            $this->request->data = $alimentacao;
        }
        
    }

    /**
     * delete method
     */
    public function delete($id = null) {
        
        $this->Alimentacao->id = $id;
        if (!$this->Alimentacao->exists()) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Alimentacao->delete()) {
            $this->Session->setFlash('Alimentação deletada com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash('Registro não foi deletado.', 'default', array('class' => 'mensagem_erro'));
        $this->redirect(array('action' => 'index'));
        
    }

}
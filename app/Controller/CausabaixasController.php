<?php
App::uses('AppController', 'Controller');

App::import('Controller', 'Users');

/**
 * Menus Controller
 */
class CausabaixasController extends AppController {
    
    
    function beforeFilter() {
        $this->set('title_for_layout', 'Causas de baixa');
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
        $this->Causabaixa->recursive = 0;
        $this->Paginator->settings = array(
            'conditions' => array('holding_id' => $dadosUser['Auth']['User']['holding_id']),
            'order' => array('descricao' => 'asc')
        );
        $this->set('causabaixas', $this->Paginator->paginate('Causabaixa'));
    }

    /**
     * view method
     */
    public function view($id = null) {
        
        if (!$this->Causabaixa->exists($id)) {
            throw new NotFoundException(__('Causa de baixa inválida'));
        }
        $options = array('conditions' => array('Causabaixa.' . $this->Causabaixa->primaryKey => $id));
        $this->set('causabaixa', $this->Causabaixa->find('first', $options));
        
    }

    /**
     * add method
     */
    public function add() {
        
        $dadosUser = $this->Session->read();
        $holding_id = $dadosUser['Auth']['User']['Holding']['id'];
        $this->set(compact('holding_id'));
        
        if ($this->request->is('post')) {
            $this->Causabaixa->create();
            if ($this->Causabaixa->save($this->request->data)) {
                $this->Session->setFlash('Causa de baixa adicionada com sucesso!', 'default', array('class' => 'mensagem_sucesso'));
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
        
        $this->Causabaixa->id = $id;
        if (!$this->Causabaixa->exists($id)) {
            throw new NotFoundException(__('Causa de baixa inválida'));
        }
        
        $dadosUser = $this->Session->read();
        $holding_id = $dadosUser['Auth']['User']['Holding']['id'];
        
        $causabaixa = $this->Causabaixa->read(null, $id);
        if ($causabaixa['Causabaixa']['holding_id'] != $holding_id) {
            throw new NotFoundException(__('Causa de baixa inválida'));
        }
        
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Causabaixa->save($this->request->data)) {
                $this->Session->setFlash('Causa de baixa alterada com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Registro não foi alterado. Por favor tente novamente.', 'default', array('class' => 'mensagem_erro'));
            }
        } else {
            $this->request->data = $this->Causabaixa->read(null, $id);
        }
        
    }

    /**
     * delete method
     */
    public function delete($id = null) {
        
        $this->Causabaixa->id = $id;
        if (!$this->Causabaixa->exists()) {
            throw new NotFoundException(__('Causa de baixa inválida'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Causabaixa->delete()) {
            $this->Session->setFlash('Causa de baixa deletada com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash('Registro não foi deletado.', 'default', array('class' => 'mensagem_erro'));
        $this->redirect(array('action' => 'index'));
        
    }

}

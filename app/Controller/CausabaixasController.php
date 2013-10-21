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
    
    public $paginate = array(
        'order' => array('nome' => 'asc')
    );
    
    /**
     * index method
     */
    public function index() {
        $this->Causabaixa->recursive = 0;
        $this->set('causabaixas', $this->paginate());
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
        $empresa_id = $dadosUser['empresa_id'];
        $this->set(compact('empresa_id'));
        
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
        $empresa_id = $dadosUser['empresa_id'];
        
        $causabaixa = $this->Causabaixa->read(null, $id);
        if ($causabaixa['Causabaixa']['empresa_id'] != $empresa_id) {
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

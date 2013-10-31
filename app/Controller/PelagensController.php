<?php
App::uses('AppController', 'Controller');

App::import('Controller', 'Users');

/**
 * Menus Controller
 */
class PelagensController extends AppController {
    
    function beforeFilter() {
        $this->set('title_for_layout', 'Pelagens');
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
        $this->Pelagem->recursive = 0;
        $this->Paginator->settings = array(
            'conditions' => array('holding_id' => $dadosUser['Auth']['User']['holding_id']),
            'order' => array('descricao' => 'asc')
        );
        $this->set('pelagens', $this->Paginator->paginate('Pelagem'));
    }

    /**
     * view method
     */
    public function view($id = null) {
        
        if (!$this->Pelagem->exists($id)) {
            throw new NotFoundException(__('Pelagem de baixa inválida'));
        }
        $options = array('conditions' => array('Pelagem.' . $this->Pelagem->primaryKey => $id));
        $this->set('pelagem', $this->Pelagem->find('first', $options));
        
    }

    /**
     * add method
     */
    public function add() {
        
        $dadosUser = $this->Session->read();
        $holding_id = $dadosUser['Auth']['User']['Holding']['id'];
        $this->set(compact('holding_id'));
        
        if ($this->request->is('post')) {
            $this->Pelagem->create();
            if ($this->Pelagem->save($this->request->data)) {
                $this->Session->setFlash('Pelagem adicionada com sucesso!', 'default', array('class' => 'mensagem_sucesso'));
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
        
        $this->Pelagem->id = $id;
        if (!$this->Pelagem->exists($id)) {
            throw new NotFoundException(__('Pelagem inválida'));
        }
        
        $dadosUser = $this->Session->read();
        $holding_id = $dadosUser['Auth']['User']['Holding']['id'];
        
        $pelagem = $this->Pelagem->read(null, $id);
        if ($pelagem['Pelagem']['holding_id'] != $holding_id) {
            throw new NotFoundException(__('Pelagem inválida'));
        }
        
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Pelagem->save($this->request->data)) {
                $this->Session->setFlash('Pelagem alterada com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Registro não foi alterado. Por favor tente novamente.', 'default', array('class' => 'mensagem_erro'));
            }
        } else {
            $this->request->data = $this->Pelagem->read(null, $id);
        }
        
    }

    /**
     * delete method
     */
    public function delete($id = null) {
        
        $this->Pelagem->id = $id;
        if (!$this->Pelagem->exists()) {
            throw new NotFoundException(__('Pelagem inválida'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Pelagem->delete()) {
            $this->Session->setFlash('Pelagem deletada com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash('Registro não foi deletado.', 'default', array('class' => 'mensagem_erro'));
        $this->redirect(array('action' => 'index'));
        
    }

}

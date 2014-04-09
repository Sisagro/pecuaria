<?php
App::uses('AppController', 'Controller');

App::import('Controller', 'Users');

/**
 * Menus Controller
 */
class GrpeventosanitariosController extends AppController {
    
    function beforeFilter() {
        $this->set('title_for_layout', 'Eventos sanitários');
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
        $this->Grpeventosanitario->recursive = 0;
        $this->Paginator->settings = array(
            'conditions' => array('holding_id' => $dadosUser['Auth']['User']['holding_id']),
            'order' => array('descricao' => 'asc')
        );
        $this->set('grpeventosanitarios', $this->Paginator->paginate('Grpeventosanitario'));
    }

    /**
     * view method
     */
    public function view($id = null) {
        
        $this->Grpeventosanitario->id = $id;
        if (!$this->Grpeventosanitario->exists()) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $dadosUser = $this->Session->read();
        $holding_id = $dadosUser['Auth']['User']['Holding']['id'];
        
        $grpeventosanitario = $this->Grpeventosanitario->read(null, $id);
        if ($grpeventosanitario['Grpeventosanitario']['holding_id'] != $holding_id) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $this->set('grpeventosanitario', $grpeventosanitario);
        
    }

    /**
     * add method
     */
    public function add() {
        
        $dadosUser = $this->Session->read();
        $holding_id = $dadosUser['Auth']['User']['Holding']['id'];
        $this->set(compact('holding_id'));
        
        if ($this->request->is('post')) {
            $this->Grpeventosanitario->create();
            if ($this->Grpeventosanitario->save($this->request->data)) {
                $this->Session->setFlash('Grupo de evento sanitário adicionado com sucesso!', 'default', array('class' => 'mensagem_sucesso'));
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
        
        $this->Grpeventosanitario->id = $id;
        if (!$this->Grpeventosanitario->exists()) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $dadosUser = $this->Session->read();
        $holding_id = $dadosUser['Auth']['User']['Holding']['id'];
        
        $grpeventosanitario = $this->Grpeventosanitario->read(null, $id);
        if ($grpeventosanitario['Grpeventosanitario']['holding_id'] != $holding_id) {
            throw new NotFoundException(__('Grupo de evento sanitário inválido'));
        }
        
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Grpeventosanitario->save($this->request->data)) {
                $this->Session->setFlash('Grupo de evento sanitário alterado com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Registro não foi alterado. Por favor tente novamente.', 'default', array('class' => 'mensagem_erro'));
            }
        } else {
            $this->request->data = $grpeventosanitario;
        }
        
    }

    /**
     * delete method
     */
    public function delete($id = null) {
        
        $this->Grpeventosanitario->id = $id;
        if (!$this->Grpeventosanitario->exists()) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Grpeventosanitario->delete()) {
            $this->Session->setFlash('Grupo de evento sanitário deletado com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
            $this->redirect(array('action' => 'index'));
        }
        if(!$this->Session->check('Message.flash')) {
            $this->Session->setFlash('Registro não foi deletado.', 'default', array('class' => 'mensagem_erro'));
        } 
        $this->redirect(array('action' => 'index'));

    }

}

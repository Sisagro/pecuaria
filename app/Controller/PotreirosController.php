<?php
App::uses('AppController', 'Controller');

App::import('Controller', 'Users');

/**
 * Menus Controller
 */
class PotreirosController extends AppController {
    
    function beforeFilter() {
        $this->set('title_for_layout', 'Potreiros');
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
        $this->Potreiro->recursive = 0;
        $this->Paginator->settings = array(
            'conditions' => array('empresa_id' => $dadosUser['empresa_id']),
            'order' => array('descricao' => 'asc')
        );
        $this->set('potreiros', $this->Paginator->paginate('Potreiro'));
        
        
//        $this->Potreiro->recursive = 0;
//        $this->set('potreiros', $this->paginate());
    }

    /**
     * view method
     */
    public function view($id = null) {
        
        if (!$this->Potreiro->exists($id)) {
            throw new NotFoundException(__('Potreiro inválido'));
        }
        $options = array('conditions' => array('Potreiro.' . $this->Potreiro->primaryKey => $id));
        $this->set('potreiro', $this->Potreiro->find('first', $options));
        
    }

    /**
     * add method
     */
    public function add() {
        
        $dadosUser = $this->Session->read();
        $empresa_id = $dadosUser['empresa_id'];
        $this->set(compact('empresa_id'));
        
        if ($this->request->is('post')) {
            if (empty($this->request->data['Potreiro']['area_lavoura'])) {
                $this->Potreiro->validator()->remove('area_lavoura');
            }
            $this->Potreiro->create();
            if ($this->Potreiro->save($this->request->data)) {
                $this->Session->setFlash('Potreiro adicionado com sucesso!', 'default', array('class' => 'mensagem_sucesso'));
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
        
        $this->Potreiro->id = $id;
        if (!$this->Potreiro->exists($id)) {
            throw new NotFoundException(__('Potreiro inválido'));
        }
        
        $dadosUser = $this->Session->read();
        $empresa_id = $dadosUser['empresa_id'];
        
        $potreiro = $this->Potreiro->read(null, $id);
        if ($potreiro['Potreiro']['empresa_id'] != $empresa_id) {
            throw new NotFoundException(__('Potreiro inválido'));
        }
        
        if ($this->request->is('post') || $this->request->is('put')) {
            if (empty($this->request->data['Potreiro']['area_lavoura'])) {
                $this->Potreiro->validator()->remove('area_lavoura');
            }
            if ($this->Potreiro->save($this->request->data)) {
                $this->Session->setFlash('Potreiro alterado com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Registro não foi alterado. Por favor tente novamente.', 'default', array('class' => 'mensagem_erro'));
            }
        } else {
            $this->request->data = $this->Potreiro->read(null, $id);
        }
        
    }

    /**
     * delete method
     */
    public function delete($id = null) {
        
        $this->Potreiro->id = $id;
        if (!$this->Potreiro->exists()) {
            throw new NotFoundException(__('Potreiro inválido'));
        }
        
        $dadosUser = $this->Session->read();
        $empresa_id = $dadosUser['empresa_id'];
        
        $potreiro = $this->Potreiro->read(null, $id);
        if ($potreiro['Potreiro']['empresa_id'] != $empresa_id) {
            throw new NotFoundException(__('Potreiro inválido'));
        }
        
        $this->request->onlyAllow('post', 'delete');
        if ($this->Potreiro->delete()) {
            $this->Session->setFlash('Potreiro deletado com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash('Registro não foi deletado.', 'default', array('class' => 'mensagem_erro'));
        $this->redirect(array('action' => 'index'));
        
    }

}

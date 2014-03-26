<?php
App::uses('AppController', 'Controller');

App::import('Controller', 'Users');

/**
 * Menus Controller
 */
class PlanosController extends AppController {
    
    function beforeFilter() {
        $this->set('title_for_layout', 'Planos');
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
        $this->Plano->recursive = 0;
        $this->Paginator->settings = array(
            'order' => array('menu' => 'asc')
        );
        $this->set('planos', $this->Paginator->paginate('Plano'));
    }

    /**
     * view method
     */
    public function view($id = null) {
        if (!$this->Plano->exists($id)) {
            throw new NotFoundException(__('Invalid menu'));
        }
        $options = array('conditions' => array('Plano.' . $this->Plano->primaryKey => $id));
        $this->set('plano', $this->Plano->find('first', $options));
    }

    /**
     * add method
     */
    public function add() {
        
        $dadosUser = $this->Session->read();
        
        if ($this->request->is('post')) {            
            $this->Plano->create();
            if ($this->Plano->save($this->request->data)) {
                $this->Session->setFlash('Plano adicionado com sucesso!', 'default', array('class' => 'mensagem_sucesso'));
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
        
        $this->Plano->id = $id;
        if (!$this->Plano->exists()) {
            throw new NotFoundException(__('Plano inválido'));
        }
        
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Plano->save($this->request->data)) {
                $this->Session->setFlash('Plano alterado com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Registro não foi alterado. Por favor tente novamente.', 'default', array('class' => 'mensagem_erro'));
            }
        } else {
            $this->request->data = $this->Plano->read(null, $id);
        }
    }

    /**
     * delete method
     */
    public function delete($id = null) {
        $this->Plano->id = $id;
        if (!$this->Plano->exists()) {
            throw new NotFoundException(__('Menu inválido'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Plano->delete()) {
            $this->Session->setFlash('Plano deletado com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash('Registro não foi deletado.', 'default', array('class' => 'mensagem_erro'));
        $this->redirect(array('action' => 'index'));
    }

}

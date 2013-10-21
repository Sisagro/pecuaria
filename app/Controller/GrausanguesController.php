<?php
App::uses('AppController', 'Controller');

App::import('Controller', 'Users');

/**
 * Grausangue Controller
 */
class GrausanguesController extends AppController {
    
    function beforeFilter() {
        $this->set('title_for_layout', 'Grau de sangue');
    }
    
    public function isAuthorized($user) {
        $Users = new UsersController;
        return $Users->validaAcesso($this->Session->read(), $this->request->controller);
        return parent::isAuthorized($user);
    }
    
    public $paginate = array(
        'order' => array('descricao' => 'asc')
    );
    
    /**
     * index method
     */
    public function index() {
        $this->Grausangue->recursive = 0;
        $this->set('grausangues', $this->paginate());
    }

    /**
     * view method
     */
    public function view($id = null) {
        
        if (!$this->Grausangue->exists($id)) {
            throw new NotFoundException(__('Grau de sangue inválido'));
        }
        $options = array('conditions' => array('Grausangue.' . $this->Grausangue->primaryKey => $id));
        $this->set('grausangue', $this->Grausangue->find('first', $options));
        
    }

    /**
     * add method
     */
    public function add() {
        
        $dadosUser = $this->Session->read();
        $empresa_id = $dadosUser['empresa_id'];
        $this->set(compact('empresa_id'));
        
        if ($this->request->is('post')) {
            $this->Grausangue->create();
            if ($this->Grausangue->save($this->request->data)) {
                $this->Session->setFlash('Grau de sangue adicionado com sucesso!', 'default', array('class' => 'mensagem_sucesso'));
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
        
        $this->Grausangue->id = $id;
        if (!$this->Grausangue->exists($id)) {
            throw new NotFoundException(__('Grau de sangue inválido'));
        }
        
        $dadosUser = $this->Session->read();
        $empresa_id = $dadosUser['empresa_id'];
        
        $grausangue = $this->Grausangue->read(null, $id);
        if ($grausangue['Grausangue']['empresa_id'] != $empresa_id) {
            throw new NotFoundException(__('Grau de sangue inválida'));
        }
        
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Grausangue->save($this->request->data)) {
                $this->Session->setFlash('Grau de sangue alterado com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Registro não foi alterado. Por favor tente novamente.', 'default', array('class' => 'mensagem_erro'));
            }
        } else {
            $this->request->data = $this->Grausangue->read(null, $id);
        }
        
    }

    /**
     * delete method
     */
    public function delete($id = null) {
        
        $this->Grausangue->id = $id;
        if (!$this->Grausangue->exists()) {
            throw new NotFoundException(__('Grau de sangue inválido'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Grausangue->delete()) {
            $this->Session->setFlash('Grau de sangue deletado com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash('Registro não foi deletado.', 'default', array('class' => 'mensagem_erro'));
        $this->redirect(array('action' => 'index'));
        
    }

}

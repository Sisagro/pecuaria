<?php

App::uses('AppController', 'Controller');

/**
 * Usergroupempresas Controller
 */
class UsergroupempresasController extends AppController {
        
    public function beforeFilter() {
        $this->set('title_for_layout', 'Perfil');
    }
    
    public $paginate = array(
        'order' => array('User.nome' => 'asc')
    );
    
    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Usergroupempresa->recursive = 0;
        $this->set('usergroupempresas', $this->paginate());
    }
    
    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Usergroupempresa->exists($id)) {
            throw new NotFoundException(__('Perfil inválido.'));
        }
        $options = array('conditions' => array('Usergroupempresa.' . $this->Usergroupempresa->primaryKey => $id));
        $this->set('usergroupempresa', $this->Usergroupempresa->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        
        $usuarios = $this->Usergroupempresa->User->find('list', array('fields'=>array('id','nome'),'conditions'=>array('holding_id' => '7'),'order'=>array('nome' => 'asc')));
        $grupos = $this->Usergroupempresa->Group->find('list', array('fields'=>array('id','name'),'conditions'=>array('holding_id' => '7'),'order'=>array('name' => 'asc')));
        $empresas = $this->Usergroupempresa->Empresa->find('list', array('fields'=>array('id','nomefantasia'),'conditions'=>array('holding_id' => '7'),'order'=>array('nomefantasia' => 'asc')));
        $opcoes = array(1 => 'SIM', 2 => 'NAO');
        $this->set(compact('usuarios', 'grupos', 'empresas', 'opcoes'));
        
        if ($this->request->is('post')) {
            $this->Usergroupempresa->create();
            if ($this->Usergroupempresa->save($this->request->data)) {
                $this->Session->setFlash('Perfil adicionado com sucesso!', 'default', array('class' => 'mensagem_sucesso'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Registro não foi salvo. Por favor tente novamente.', 'default', array('class' => 'mensagem_erro'));
            }
        }
        
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Usergroupempresa->exists($id)) {
            throw new NotFoundException(__('Perfil inválido.'));
        }
        $this->Usergroupempresa->id = $id;
        
        $usuarios = $this->Usergroupempresa->User->find('list', array('fields'=>array('id','nome'),'conditions'=>array('holding_id' => '7'),'order'=>array('nome' => 'asc')));
        $grupos = $this->Usergroupempresa->Group->find('list', array('fields'=>array('id','name'),'conditions'=>array('holding_id' => '7'),'order'=>array('name' => 'asc')));
        $empresas = $this->Usergroupempresa->Empresa->find('list', array('fields'=>array('id','nomefantasia'),'conditions'=>array('holding_id' => '7'),'order'=>array('nomefantasia' => 'asc')));
        $opcoes = array(1 => 'SIM', 2 => 'NAO');
        $this->set(compact('usuarios', 'grupos', 'empresas', 'opcoes'));
        
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Usergroupempresa->save($this->request->data)) {
                $this->Session->setFlash('Perfil alterado com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Registro não foi alterado. Por favor tente novamente.', 'default', array('class' => 'mensagem_erro'));
            }
        } else {
            $options = array('conditions' => array('Usergroupempresa.' . $this->Usergroupempresa->primaryKey => $id));
            $this->request->data = $this->Usergroupempresa->find('first', $options);
        }
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Usergroupempresa->id = $id;
        if (!$this->Usergroupempresa->exists()) {
            throw new NotFoundException(__('Perfil inválido.'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Usergroupempresa->delete()) {
            $this->Session->setFlash('Perfil deletado com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash('Perfil não foi deletado.', 'default', array('class' => 'mensagem_erro'));
        $this->redirect(array('action' => 'index'));
    }

}

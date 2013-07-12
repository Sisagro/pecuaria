<?php

App::uses('AppController', 'Controller');

/**
 * Usergroupempresas Controller
 */
class UsergroupempresasController extends AppController {

    function beforeFilter() {
        $this->set('title_for_layout', 'Víncular perfil');
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
            throw new NotFoundException(__('Invalid usergroupempresa'));
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
        
        $cadastrados = $this->Usergroupempresa->find('list', array('fields'=>array('user_id'),'conditions'=>array('empresa_id' => '8')));
        $this->Usergroupempresa->recursive = 0;
//        $allPublishedAuthors = $this->Usergroupempresa->User->find('all');
        
//        $this->Usergroupempresa->User->recursive = 1;
//        $allPublishedAuthors = $this->Usergroupempresa->User->find('all', array(
//                    'conditions' => array('Usergroupempresas.id' => '11'),
//                    'joins' => array(
//                      array(
//                        'alias' => 'Usergroupempresas',
//                        'table' => 'usergroupempresas',
//                        'type' => 'LEFT',
//                        'conditions' => '"Usergroupempresas"."user_id" = "User"."id"'
//                      )
//                    )
//                  ));
        
        
//        $allPublishedAuthors = $this->Usergroupempresa->User->find('all', array(
//            'conditions' => array('Holding.id ' => '9')
//        ));

//        debug($allPublishedAuthors);
        $usuarios = $this->Usergroupempresa->User->find('list', array('fields'=>array('id','nome'),'conditions'=>array('holding_id' => '9'),'order'=>array('nome' => 'asc')));
        $grupos = $this->Usergroupempresa->Group->find('list', array('fields'=>array('id','name'),'conditions'=>array('holding_id' => '9'),'order'=>array('name' => 'asc')));
        $opcoes = array(1 => 'SIM', 2 => 'NAO');
        $this->set(compact('usuarios', 'grupos', 'opcoes'));
        
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
            throw new NotFoundException(__('Invalid usergroupempresa'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Usergroupempresa->save($this->request->data)) {
                $this->Session->setFlash(__('The usergroupempresa has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The usergroupempresa could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Usergroupempresa.' . $this->Usergroupempresa->primaryKey => $id));
            $this->request->data = $this->Usergroupempresa->find('first', $options);
        }
        $users = $this->Usergroupempresa->User->find('list');
        $empresas = $this->Usergroupempresa->Empresa->find('list');
        $groups = $this->Usergroupempresa->Group->find('list');
        $this->set(compact('users', 'empresas', 'groups'));
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
            throw new NotFoundException(__('Invalid usergroupempresa'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Usergroupempresa->delete()) {
            $this->Session->setFlash(__('Usergroupempresa deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Usergroupempresa was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

}

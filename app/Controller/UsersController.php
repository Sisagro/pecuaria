<?php

App::uses('AppController', 'Controller');

/**
 * Users Controller
 */
class UsersController extends AppController {
    
    public $name = 'Users';
    
    public function isAuthorized($user) {
//        if ($this->request->params['controller'] == "users" || $this->request->params['controller'] == "groups") {
//            return true;
//        } else {
//            return false;
//        }
        return parent::isAuthorized($user);
    }
    
    
    
    public function beforeFilter() {
        $this->set('title_for_layout', 'Usuários');
    }
    
    public $paginate = array(
        'order' => array('nome' => 'asc')
    );
    
    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }
    
    public function validaAcesso() {
        
        return false;
    }
    
    public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                //Grava último acesso do usuário
                $this->User->read(null, $this->Auth->user('id'));
                $this->User->saveField('ultimoacesso', date('Y-m-d H:i:s'));
                
                // testa se existe um perfil pra ele em uma empresa
                $this->loadModel('Usergroupempresa');
                $empresas = $this->Usergroupempresa->find('all', array(
                    'fields' => array('Empresa.id', 'Empresa.nomefantasia'),
                    'conditions' => array('user_id' => $this->User->id,
                )));
//                debug($empresas);
//                die();
                $perfil = $this->Usergroupempresa->find('all', array(
                    'conditions' => array('user_id' => $this->User->id, 
                                          'empresaboot' => 1,
                )));
                CakeSession::write('nomeEmpresa', $perfil[0]['Empresa']['nomefantasia']);
                CakeSession::write('empresa_id', $perfil[0]['Empresa']['id']);
                CakeSession::write('empresasCombo', $empresas);
                $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash('Usuário ou senha incorretos.', 'default', array('class' => 'mensagem_erro'));
            }
        }
    }
    
    public function logout() {
        $this->redirect($this->Auth->logout());
    }
    
    public function trocaEmpresa($empresa) {
        if ($this->request->is('get')) {
            // testa se existe um perfil pra ele em uma empresa
            $this->loadModel('Usergroupempresa');
            $perfil = $this->Usergroupempresa->find('all', array(
                'conditions' => array('user_id' => $this->Auth->user('id'), 
                                      'empresa_id' => $empresa,
            )));
            CakeSession::write('nomeEmpresa', $perfil[0]['Empresa']['nomefantasia']);
            CakeSession::write('empresa_id', $perfil[0]['Empresa']['id']);
            $this->redirect(array('controller' => 'homes', 'action' => 'index'));
        }
    }
    
    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->read(null, $id));
    }

    public function add() {
        
        $holdings = $this->User->Holding->find('list', array(
            'fields' => array('id', 'nome'),
            'order' => 'nome ASC'
        ));
        $this->set(compact('holdings'));
        
        $opcoes = array(1 => 'SIM', 2 => 'NÃO');
        $this->set('opcoes', $opcoes);
        
        if ($this->request->is('post')) {
            $this->User->create();
            $this->request->data['User']['username'] = $this->request->data['User']['email'];
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash('Usuário salvo com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Registro não foi salvo. Por favor tente novamente.', 'default', array('class' => 'mensagem_erro'));
            }
        }
    }

    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Registro inválido.'));
        }
        
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Registro inválido.'));
        }
        
        $opcoes = array(1 => 'SIM', 2 => 'NÃO');
        $this->set('opcoes', $opcoes);
        
        $holdings = $this->User->Holding->find('list', array(
            'fields' => array('id', 'nome'),
            'order' => 'nome ASC'
        ));
        $this->set(compact('holdings'));
        
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash('Usuário alterado com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
                $this->redirect(array('action' => 'index'));
            } else {
               $this->Session->setFlash('Registro não foi alterado. Por favor tente novamente.', 'default', array('class' => 'mensagem_erro'));
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
        }
    }

    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash('Usuário deletado com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash('Registro não foi deletado.', 'default', array('class' => 'mensagem_erro'));
        $this->redirect(array('action' => 'index'));
    }

}

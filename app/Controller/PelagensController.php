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
    
    /**
     * index method
     */
    public function index() {
        $dadosUser = $this->Session->read();
        $this->Pelagen->Raca->Especy->recursive = -1;
        $especies = $this->Pelagen->Raca->Especy->find('list', array(
            'conditions' => array('holding_id' => $dadosUser['Auth']['User']['holding_id']),
            'order' => array('descricao' => 'asc')
        ));
        $this->Pelagen->recursive = 0;
        $this->Paginator->settings = array(
            'conditions' => array('Raca.especie_id' => $especies),
            'order' => array('descricao' => 'asc')
        );
        $this->set('pelagens', $this->Paginator->paginate('Pelagen'));
    }

    /**
     * view method
     */
    public function view($id = null) {
        
        $this->Pelagen->id = $id;
        if (!$this->Pelagen->exists()) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $dadosUser = $this->Session->read();
        $holding_id = $dadosUser['Auth']['User']['Holding']['id'];
        $this->Pelagen->recursive = 2;
        $pelagem = $this->Pelagen->read(null, $id);
        if ($pelagem['Raca']['Especy']['holding_id'] != $holding_id) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $this->set('pelagem', $pelagem);
        
    }

    /**
     * add method
     */
    public function add() {
        
        $dadosUser = $this->Session->read();
        $this->Pelagen->Raca->Especy->recursive = -1;
        $especies = $this->Pelagen->Raca->Especy->find('list', array(
            'fields' => array('id', 'descricao'),
            'conditions' => array('holding_id' => $dadosUser['Auth']['User']['holding_id']),
            'order' => array('descricao' => 'asc')
        ));
        $this->set('especies', $especies);
        
        if ($this->request->is('post')) {
            $this->Pelagen->create();
            if ($this->Pelagen->save($this->request->data)) {
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
        
        $this->Pelagen->id = $id;
        if (!$this->Pelagen->exists($id)) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $dadosUser = $this->Session->read();
        $holding_id = $dadosUser['Auth']['User']['Holding']['id'];
        $this->Pelagen->recursive = 2;
        $pelagem = $this->Pelagen->read(null, $id);
        if ($pelagem['Raca']['Especy']['holding_id'] != $holding_id) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $this->Pelagen->Raca->Especy->recursive = -1;
        $especies = $this->Pelagen->Raca->Especy->find('list', array(
            'conditions' => array('holding_id' => $holding_id),
            'order' => array('descricao' => 'asc')
        ));
        
        $racas = $this->Pelagen->Raca->find('list', array(
            'fields' => array('id', 'descricao'), 
            'conditions' => array('especie_id' => $especies),
            'order' => array('descricao' => 'asc')
        ));
        $this->set(compact('racas'));
                
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Pelagen->save($this->request->data)) {
                $this->Session->setFlash('Pelagem alterada com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Registro não foi alterado. Por favor tente novamente.', 'default', array('class' => 'mensagem_erro'));
            }
        } else {
            $this->request->data = $pelagem;
        }
        
    }

    /**
     * delete method
     */
    public function delete($id = null) {
        
        $this->Pelagen->id = $id;
        if (!$this->Pelagen->exists()) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Pelagen->delete()) {
            $this->Session->setFlash('Pelagem deletada com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash('Registro não foi deletado.', 'default', array('class' => 'mensagem_erro'));
        $this->redirect(array('action' => 'index'));
        
    }

}

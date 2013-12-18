<?php
App::uses('AppController', 'Controller');

App::import('Controller', 'Users');

/**
 * Menus Controller
 */
class EspeciesController extends AppController {

    function beforeFilter() {
        $this->set('title_for_layout', 'Espécies');
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
        $this->Especy->recursive = 0;
        $this->Paginator->settings = array(
            'conditions' => array('holding_id' => $dadosUser['Auth']['User']['holding_id']),
            'order' => array('descricao' => 'asc')
        );
        $this->set('especies', $this->Paginator->paginate('Especy'));
    }
    
    /**
     * view method
     */
    public function view($id = null) {
        
        $this->Especy->id = $id;
        if (!$this->Especy->exists()) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $dadosUser = $this->Session->read();
        $holding_id = $dadosUser['Auth']['User']['Holding']['id'];
        
        $especie = $this->Especy->read(null, $id);
        if ($especie['Especy']['holding_id'] != $holding_id) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $this->set('especie', $especie);
        
    }
    
    /**
     * add method
     */
    public function add() {
        
        $dadosUser = $this->Session->read();
        $holding_id = $dadosUser['Auth']['User']['Holding']['id'];
        $this->set(compact('holding_id'));
        
        if ($this->request->is('post')) {
            $this->Especy->create();
            if ($this->Especy->save($this->request->data)) {
                $this->Session->setFlash('Espécie adicionada com sucesso!', 'default', array('class' => 'mensagem_sucesso'));
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
        
        $this->Especy->id = $id;
        if (!$this->Especy->exists($id)) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $dadosUser = $this->Session->read();
        $holding_id = $dadosUser['Auth']['User']['Holding']['id'];
        
        $especie = $this->Especy->read(null, $id);
        if ($especie['Especy']['holding_id'] != $holding_id) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Especy->save($this->request->data)) {
                $this->Session->setFlash('Espécie alterada com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Registro não foi alterado. Por favor tente novamente.', 'default', array('class' => 'mensagem_erro'));
            }
        } else {
            $this->request->data = $especie;
        }
        
    }

    /**
     * delete method
     */
    public function delete($id = null) {
        
        $this->Especy->id = $id;
        if (!$this->Especy->exists()) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Especy->delete()) {
            $this->Session->setFlash('Espécie deletada com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash('Registro não foi deletado.', 'default', array('class' => 'mensagem_erro'));
        $this->redirect(array('action' => 'index'));
        
    }
    
}

?>

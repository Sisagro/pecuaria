<?php
App::uses('AppController', 'Controller');

App::import('Controller', 'Users');

/**
 * Raças Controller
 */
class RacasController extends AppController {
    
    function beforeFilter() {
        $this->set('title_for_layout', 'Raças');
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
        $this->Raca->recursive = 0;
        $this->Paginator->settings = array(
            'conditions' => array('Especy.holding_id' => $dadosUser['Auth']['User']['holding_id']),
            'order' => array('descricao' => 'asc')
        );
        $this->set('racas', $this->Paginator->paginate('Raca'));
    }
    
    /**
     * view method
     */
    public function view($id = null) {
        
        $this->Raca->id = $id;
        if (!$this->Raca->exists()) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $dadosUser = $this->Session->read();
        $holding_id = $dadosUser['Auth']['User']['Holding']['id'];
        $raca = $this->Raca->read(null, $id);
        if ($raca['Especy']['holding_id'] != $holding_id) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $this->set('raca', $raca);
        
    }

    /**
     * add method
     */
    public function add() {
        
        $dadosUser = $this->Session->read();
        $especies = $this->Raca->Especy->find('list', array(
            'fields' => array('id', 'descricao'), 
            'conditions' => array('holding_id' => $dadosUser['Auth']['User']['holding_id']),
            'order' => array('descricao' => 'asc')
        ));
        $this->set(compact('especies'));
        
        if ($this->request->is('post')) {
            $this->Raca->create();
            if ($this->Raca->save($this->request->data)) {
                $this->Session->setFlash('Raça adicionada com sucesso!', 'default', array('class' => 'mensagem_sucesso'));
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
        
        $this->Raca->id = $id;
        if (!$this->Raca->exists()) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $dadosUser = $this->Session->read();
        $holding_id = $dadosUser['Auth']['User']['Holding']['id'];
        $raca = $this->Raca->read(null, $id);
        if ($raca['Especy']['holding_id'] != $holding_id) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $especies = $this->Raca->Especy->find('list', array(
            'fields' => array('id', 'descricao'), 
            'conditions' => array('holding_id' => $holding_id),
            'order' => array('descricao' => 'asc')
        ));
        $this->set(compact('especies'));
        
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Raca->save($this->request->data)) {
                $this->Session->setFlash('Raça alterada com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Registro não foi alterado. Por favor tente novamente.', 'default', array('class' => 'mensagem_erro'));
            }
        } else {
            $this->request->data = $raca;
        }
        
    }

    /**
     * delete method
     */
    public function delete($id = null) {
        
        $this->Raca->id = $id;
        if (!$this->Raca->exists()) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $this->request->onlyAllow('post', 'delete');
        if ($this->Raca->delete()) {
            $this->Session->setFlash('Raça deletada com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash('Registro não foi deletado.', 'default', array('class' => 'mensagem_erro'));
        $this->redirect(array('action' => 'index'));
        
    }
    
    /**
     * Funções ajax
     */
    
    public function buscaRacas($chave) {
        $this->layout = 'ajax';
        if (array_key_exists("especie_id", $this->request->data[$chave])) {
            $catID = $this->request->data[$chave]['especie_id'];
        }
        $racas = $this->Raca->find('list' , array('order' => 'descricao ASC','fields' => array('Raca.id', 'Raca.descricao'),'conditions' => array('Raca.especie_id' => $catID)));
        $this->set('racas', $racas);
    }
    
}
?>

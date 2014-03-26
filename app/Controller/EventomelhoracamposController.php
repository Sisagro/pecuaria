<?php
App::uses('AppController', 'Controller');

App::import('Controller', 'Users');

/**
 * Menus Controller
 */
class EventomelhoracamposController extends AppController {
    
    function beforeFilter() {
        $this->set('title_for_layout', 'Evento m. campo');
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
        $this->Eventomelhoracampo->recursive = 0;
        $this->Paginator->settings = array(
            'conditions' => array('Eventomelhoracampo.empresa_id' => $dadosUser['empresa_id']),
            'order' => array('descricao' => 'asc')
        );
        $this->set('eventomelhoracampos', $this->Paginator->paginate('Eventomelhoracampo'));
    }

    /**
     * view method
     */
    public function view($id = null) {
        
        $this->Eventomelhoracampo->id = $id;
        if (!$this->Eventomelhoracampo->exists()) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $dadosUser = $this->Session->read();
        $empresa_id = $dadosUser['empresa_id'];
        
        $this->Eventomelhoracampo->recursive = 2;
        $eventomelhoracampo = $this->Eventomelhoracampo->read(null, $id);
        
        if ($eventomelhoracampo['Eventomelhoracampo']['empresa_id'] != $empresa_id) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $this->set('eventomelhoracampo', $eventomelhoracampo);
               
    }

    /**
     * add method
     */
    public function add() {
        
        $dadosUser = $this->Session->read();
        
        $this->set('empresa', $dadosUser['empresa_id']);
        
        $melhoracampos = $this->Eventomelhoracampo->Melhoracampo->find('list', array(
            'fields' => array('id', 'descricao'), 
            'conditions' => array('holding_id' => $dadosUser['Auth']['User']['holding_id']),
            'order' => array('descricao' => 'asc')
        ));
        $this->set(compact('melhoracampos'));                
        
        $potreiros = $this->Eventomelhoracampo->Potreiro->find('list', array(
            'fields' => array('id', 'descricao'), 
            'conditions' => array('empresa_id' => $dadosUser['empresa_id']),
            'order' => array('descricao' => 'asc')
        ));
        $this->set(compact('potreiros'));
        
        if ($this->request->is('post')) {
            $this->Eventomelhoracampo->create();
            if ($this->Eventomelhoracampo->save($this->request->data)) {
                $this->Session->setFlash('Melhoramento de campo adicionado com sucesso!', 'default', array('class' => 'mensagem_sucesso'));
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
        
        $this->Eventomelhoracampo->id = $id;
        if (!$this->Eventomelhoracampo->exists()) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $dadosUser = $this->Session->read();
        
        $holding_id = $dadosUser['Auth']['User']['Holding']['id'];
        
        $melhoracampo = $this->Eventomelhoracampo->read(null, $id);       
        if ($melhoracampo['Melhoracampo']['holding_id'] != $holding_id) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $melhoracampos = $this->Eventomelhoracampo->Melhoracampo->find('list', array(
            'fields' => array('id', 'descricao'), 
            'conditions' => array('holding_id' => $holding_id),
            'order' => array('descricao' => 'asc')
        ));
        $this->set(compact('melhoracampos'));
        
//        $potreiro = $this->Eventomelhoracampo->read(null, $id);       
//        if ($potreiro['Eventomelhoracampo']['potreiro_id'] != $holding_id) {
//            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
//            $this->redirect(array('action' => 'index'));
//        }
        
//        $potreiros = $this->Eventomelhoracampo->Potreiro->find('list', array(
//            'fields' => array('id', 'descricao'), 
//            'conditions' => array('potreiro_id' => $potreiro_id),
//            'order' => array('descricao' => 'asc')
//        ));
//        $this->set(compact('potreiros'));
        
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Eventomelhoracampo->save($this->request->data)) {
                $this->Session->setFlash('Evento de melhoramento de campo alterado com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Registro não foi alterado. Por favor tente novamente.', 'default', array('class' => 'mensagem_erro'));
            }
        } else {
            $this->request->data = $this->Eventomelhoracampo->read(null, $id);
        }
        
    }

    /**
     * delete method
     */
    public function delete($id = null) {
        
        $this->Eventomelhoracampo->id = $id;
        if (!$this->Eventomelhoracampo->exists()) {
            throw new NotFoundException(__('Evento de melhoria de campo inválido'));
        }
        
        $this->request->onlyAllow('post', 'delete');
        if ($this->Eventomelhoracampo->delete()) {
            $this->Session->setFlash('Evento de melhoria de campo deletado com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash('Registro não foi deletado.', 'default', array('class' => 'mensagem_erro'));
        $this->redirect(array('action' => 'index'));
        
    }
    
    /**
     * Funções ajax
     */
    
//    public function buscaMedicamentos($chave) {
//        $this->layout = 'ajax';
//        if (array_key_exists("grpeventosanitario_id", $this->request->data[$chave])) {
//            $catID = $this->request->data[$chave]['grpeventosanitario_id'];
//        }
//        $medicamentos = $this->Eventomelhoracampo->find('list' , array('order' => 'descricao ASC','fields' => array('id', 'descricao'),'conditions' => array('grpeventosanitario_id' => $catID)));
//        $this->set('medicamentos', $medicamentos);
//    }

}

?>

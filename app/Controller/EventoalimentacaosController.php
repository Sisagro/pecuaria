<?php

App::uses('AppController', 'Controller');

App::import('Controller', 'Users');

/**
 * Alimentacaos Controller
 */
class EventoalimentacaosController extends AppController {
    
    function beforeFilter() {
        $this->set('title_for_layout', 'Evento alimentação');
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
        $this->Eventoalimentacao->recursive = 2;
        $this->Paginator->settings = array(
            'conditions' => array('Eventoalimentacao.empresa_id' => $dadosUser['empresa_id']),
            'order' => array('dtalimentacao' => 'desc'),
        );
        
        $this->set('itens', $this->Paginator->paginate('Eventoalimentacao'));
        
    }
    
    /**
     * view method
     */
    public function view($id = null) {
        
        $this->Eventoalimentacao->id = $id;
        if (!$this->Eventoalimentacao->exists($id)) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $dadosUser = $this->Session->read();
        $empresa_id = $dadosUser['empresa_id'];
        
        $this->Eventoalimentacao->recursive = 2;
        $eventoalimentacao = $this->Eventoalimentacao->read(null, $id);
        
        if ($eventoalimentacao['Eventoalimentacao']['empresa_id'] != $empresa_id) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $this->set('item', $eventoalimentacao);
        
    }
    
    
    /**
     * add method
     */
    public function add() {
        
        $dadosUser = $this->Session->read();
        
        $holding_id = $dadosUser['Auth']['User']['Holding']['id'];
        $this->set(compact('holding_id'));
        
        $this->set('usuario', $dadosUser['Auth']['User']['id']);
        
        $this->set('empresa', $dadosUser['empresa_id']);                
        
        $lotes = $this->Eventoalimentacao->Categorialote->find('list', array(
            'fields' => array('Lote.id', 'Lote.descricao'),
            "joins" => array(
                array(
                    "table" => "lotes",
                    "alias" => "Lote",
                    "type" => "INNER",
                    "conditions" => array("Categorialote.lote_id = Lote.id",
                                          "Lote.empresa_id = " . $dadosUser['empresa_id'])
                )
            ),
            'order' => array('Lote.descricao' => 'asc')
        ));
        
        $this->set(compact('lotes'));
        
        $alimentacaos = $this->Eventoalimentacao->Alimentacao->find('list', array(
            'fields' => array('id', 'descricao'), 
            'conditions' => array('holding_id' => $holding_id),
            'order' => array('descricao' => 'asc')
        ));
        $this->set(compact('alimentacaos'));
        
        if ($this->request->is('post')) {
            
//            debug($this->request->data); die();
            
            $this->Eventoalimentacao->create();
            if ($this->Eventoalimentacao->saveAll($this->request->data)) {
                $this->Session->setFlash('Alimentação criada com sucesso!', 'default', array('class' => 'mensagem_sucesso'));
                $this->redirect(array('action' => 'index'));
            } else {
                $errors = $this->Eventoalimentacao->validationErrors;
                if (isset($errors['erro'][0]['message'])) {
                    $this->Session->setFlash('Registro não foi salvo. ' . $errors['erro'][0]['message'], 'default', array('class' => 'mensagem_erro'));
                } else {
                    $this->Session->setFlash('Registro não foi salvo. Por favor tente novamente.', 'default', array('class' => 'mensagem_erro'));
                }
            }
        }
        
    }
    
    
    /**
     * edit method
     */
    public function edit($id = null) {
        
        $this->Eventoalimentacao->id = $id;
        if (!$this->Eventoalimentacao->exists()) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $dadosUser = $this->Session->read();
        $empresa_id = $dadosUser['empresa_id'];
        $eventoalimentacao = $this->Eventoalimentacao->read(null, $id);
        if ($eventoalimentacao['Eventoalimentacao']['empresa_id'] != $empresa_id) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Eventoalimentacao->saveField('dtalimentacao', $this->request->data['Eventoalimentacao']['dtalimentacao']) && $this->Eventoalimentacao->saveField('observacao', $this->request->data['Eventoalimentacao']['observacao'])) {
                $this->Session->setFlash('Alimentação alterada com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Registro não foi alterado. Por favor tente novamente.', 'default', array('class' => 'mensagem_erro'));
            }
        } else {
            $this->request->data = $eventoalimentacao;
        }
        
    }
    
    
    /**
     * delete method
     */
    public function delete($id = null) {
        
        $this->Eventoalimentacao->id = $id;
        if (!$this->Eventoalimentacao->exists()) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $this->request->onlyAllow('post', 'delete');
        if ($this->Eventoalimentacao->delete()) {
            $this->Session->setFlash('Alimentação deletada com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash('Registro não foi deletado.', 'default', array('class' => 'mensagem_erro'));
        $this->redirect(array('action' => 'index'));
        
    }

}
    
?>
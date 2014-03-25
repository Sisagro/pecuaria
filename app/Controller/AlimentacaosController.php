<?php

App::uses('AppController', 'Controller');

App::import('Controller', 'Users');

/**
 * Alimentacaos Controller
 */
class AlimentacaosController extends AppController {
    
    function beforeFilter() {
        $this->set('title_for_layout', 'Alimentação');
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
        $this->Alimentacao->recursive = 2;
        $this->Paginator->settings = array(
            'conditions' => array('Alimentacao.empresa_id' => $dadosUser['empresa_id']),
            'order' => array('dtalimentacao' => 'desc'),
        );
        
        $this->set('itens', $this->Paginator->paginate('Alimentacao'));
        
    }
    
    
    /**
     * view method
     */
    public function view($id = null) {
        
        $this->Alimentacao->id = $id;
        if (!$this->Alimentacao->exists($id)) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $dadosUser = $this->Session->read();
        $empresa_id = $dadosUser['empresa_id'];
        
        $this->Alimentacao->recursive = 2;
        $alimentacao = $this->Alimentacao->read(null, $id);
        
        if ($alimentacao['Alimentacao']['empresa_id'] != $empresa_id) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $this->set('item', $alimentacao);
        
    }
    
    
    /**
     * add method
     */
    public function add() {
        
        $dadosUser = $this->Session->read();
        
        $this->set('usuario', $dadosUser['Auth']['User']['id']);
        
        $this->set('empresa', $dadosUser['empresa_id']);
        
        $lotes = $this->Alimentacao->Categorialote->find('list', array(
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
        
        $melhoracampos = $this->Alimentacao->Eventomelhoracampo->find('list', array(
            'fields' => array('Eventomelhoracampo.id', 'Melhoracampo.descricao'),
            "joins" => array(
                array(
                    "table" => "melhoracampos",
                    "alias" => "Melhoracampo",
                    "type" => "INNER",
                    "conditions" => array("Eventomelhoracampo.melhoracampo_id = Melhoracampo.id",
                                          "Eventomelhoracampo.empresa_id = " . $dadosUser['empresa_id'])
                )
            ),
            'order' => array('Melhoracampo.descricao' => 'asc')
        ));
        
        $this->set(compact('melhoracampos'));
        
        if ($this->request->is('post')) {
            
//            debug($this->request->data); die();
            
            $this->Alimentacao->create();
            if ($this->Alimentacao->saveAll($this->request->data)) {
                $this->Session->setFlash('Alimentação criada com sucesso!', 'default', array('class' => 'mensagem_sucesso'));
                $this->redirect(array('action' => 'index'));
            } else {
                $errors = $this->Alimentacao->validationErrors;
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
        
        $this->Alimentacao->id = $id;
        if (!$this->Alimentacao->exists()) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $dadosUser = $this->Session->read();
        $empresa_id = $dadosUser['empresa_id'];
        $alimentacao = $this->Alimentacao->read(null, $id);
        
        if ($alimentacao['Alimentacao']['empresa_id'] != $empresa_id) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        if ($this->request->is('post') || $this->request->is('put')) {
            
            if ($this->Alimentacao->saveField('dtalimentacao', $this->request->data['Alimentacao']['dtalimentacao']) && $this->Alimentacao->saveField('observacao', $this->request->data['Alimentacao']['observacao'])) {
                $this->Session->setFlash('Alimentação alterada com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Registro não foi alterado. Por favor tente novamente.', 'default', array('class' => 'mensagem_erro'));
            }
        } else {
            $this->request->data = $alimentacao;
        }
        
    }
    
    
    /**
     * delete method
     */
    public function delete($id = null) {
        
        $this->Alimentacao->id = $id;
        if (!$this->Alimentacao->exists()) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $this->request->onlyAllow('post', 'delete');
        if ($this->Alimentacao->delete()) {
            $this->Session->setFlash('Alimentação deletada com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash('Registro não foi deletado.', 'default', array('class' => 'mensagem_erro'));
        $this->redirect(array('action' => 'index'));
        
    }

}
    
?>

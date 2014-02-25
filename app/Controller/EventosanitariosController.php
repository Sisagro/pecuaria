<?php

App::uses('AppController', 'Controller');

App::import('Controller', 'Users');

/**
 * Eventosanitarios Controller
 */
class EventosanitariosController extends AppController {
    
    function beforeFilter() {
        $this->set('title_for_layout', 'Evento sanitário');
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
        $this->Eventosanitario->recursive = 2;
        $this->Paginator->settings = array(
            'conditions' => array('Eventosanitario.empresa_id' => $dadosUser['empresa_id']),
            'order' => array('dtevento' => 'desc'),
        );
        $eventosanitario = $this->Paginator->paginate('Eventosanitario');
        $this->set('itens', $eventosanitario);
                
    }
    
    
    /**
     * view method
     */
    public function view($id = null) {
        
        $this->Eventosanitario->id = $id;
        if (!$this->Eventosanitario->exists($id)) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $dadosUser = $this->Session->read();
        $empresa_id = $dadosUser['empresa_id'];
        
        $this->Eventosanitario->recursive = 2;
        $eventosanitario = $this->Eventosanitario->read(null, $id);
        
        if ($eventosanitario['Eventosanitario']['empresa_id'] != $empresa_id) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $this->set('item', $eventosanitario);
               
    }
    
    
    /**
     * add method
     */
    public function add() {
        
        $dadosUser = $this->Session->read();
        
        $this->set('usuario', $dadosUser['Auth']['User']['id']);
        
        $this->set('empresa', $dadosUser['empresa_id']);
        
        $grpeventosanitarios = $this->Eventosanitario->Medicamento->Grpeventosanitario->find('list', array(
            'fields' => array('id', 'descricao'),
            'conditions' => array('holding_id' => $dadosUser['Auth']['User']['holding_id']),
            'order' => array('descricao' => 'asc')
        ));
        
        $this->set(compact('grpeventosanitarios'));
        
        $lotes = $this->Eventosanitario->Categorialote->find('list', array(
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
        
        if ($this->request->is('post')) {
            
//            debug($this->request->data); die();
            
            $this->Eventosanitario->create();
            if ($this->Eventosanitario->saveAll($this->request->data)) {
                $this->Session->setFlash('Evento sanitário criado com sucesso!', 'default', array('class' => 'mensagem_sucesso'));
                $this->redirect(array('action' => 'index'));
            } else {
                $errors = $this->Eventosanitario->validationErrors;
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
        
        $this->Eventosanitario->id = $id;
        if (!$this->Eventosanitario->exists()) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $dadosUser = $this->Session->read();
        $empresa_id = $dadosUser['empresa_id'];
        $eventosanitario = $this->Eventosanitario->read(null, $id);
        if ($eventosanitario['Eventosanitario']['empresa_id'] != $empresa_id) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Eventosanitario->save($this->request->data)) {
                $this->Session->setFlash('Categoria alterada com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Registro não foi alterado. Por favor tente novamente.', 'default', array('class' => 'mensagem_erro'));
            }
        } else {
            $this->request->data = $eventosanitario;
        }
        
    }
    
    
    /**
     * delete method
     */
    public function delete($id = null) {
        
        $this->Eventosanitario->id = $id;
        if (!$this->Eventosanitario->exists()) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $this->request->onlyAllow('post', 'delete');
        if ($this->Eventosanitario->delete()) {
            $this->Session->setFlash('Evento sanitário deletado com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash('Registro não foi deletado.', 'default', array('class' => 'mensagem_erro'));
        $this->redirect(array('action' => 'index'));
        
    }

}
    
?>

<?php
App::uses('AppController', 'Controller');

App::import('Controller', 'Users');

/**
 * Menus Controller
 */
class MedicamentosController extends AppController {
    
    function beforeFilter() {
        $this->set('title_for_layout', 'Medicamentos');
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
        $this->Medicamento->recursive = 0;
        $this->Paginator->settings = array(
            'conditions' => array('Grpeventosanitario.holding_id' => $dadosUser['Auth']['User']['holding_id']),
            'order' => array('descricao' => 'asc')
        );
        $this->set('medicamentos', $this->Paginator->paginate('Medicamento'));
    }

    /**
     * view method
     */
    public function view($id = null) {
        
        $this->Medicamento->id = $id;
        if (!$this->Medicamento->exists()) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $dadosUser = $this->Session->read();
        $holding_id = $dadosUser['Auth']['User']['Holding']['id'];
        $medicamento = $this->Medicamento->read(null, $id);
        if ($medicamento['Grpeventosanitario']['holding_id'] != $holding_id) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $this->set('medicamento', $medicamento);
        
    }

    /**
     * add method
     */
    public function add() {
        
        $dadosUser = $this->Session->read();
        $grpeventosanitarios = $this->Medicamento->Grpeventosanitario->find('list', array(
            'fields' => array('id', 'descricao'), 
            'conditions' => array('holding_id' => $dadosUser['Auth']['User']['holding_id']),
            'order' => array('descricao' => 'asc')
        ));
        $this->set(compact('grpeventosanitarios'));
        
        if ($this->request->is('post')) {
            $this->Medicamento->create();
            if ($this->Medicamento->save($this->request->data)) {
                $this->Session->setFlash('Medicamento adicionado com sucesso!', 'default', array('class' => 'mensagem_sucesso'));
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
        
        $this->Medicamento->id = $id;
        if (!$this->Medicamento->exists()) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $dadosUser = $this->Session->read();
        $holding_id = $dadosUser['Auth']['User']['Holding']['id'];
        $medicamento = $this->Medicamento->read(null, $id);
        if ($medicamento['Grpeventosanitario']['holding_id'] != $holding_id) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $grpeventosanitarios = $this->Medicamento->Grpeventosanitario->find('list', array(
            'fields' => array('id', 'descricao'), 
            'conditions' => array('holding_id' => $holding_id),
            'order' => array('descricao' => 'asc')
        ));
        $this->set(compact('grpeventosanitarios'));
        
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Medicamento->save($this->request->data)) {
                $this->Session->setFlash('Medicamento alterado com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Registro não foi alterado. Por favor tente novamente.', 'default', array('class' => 'mensagem_erro'));
            }
        } else {
            $this->request->data = $this->Medicamento->read(null, $id);
        }
        
    }

    /**
     * delete method
     */
    public function delete($id = null) {
        
        $this->Medicamento->id = $id;
        if (!$this->Medicamento->exists()) {
            throw new NotFoundException(__('Medicamento inválido'));
        }
        
        $this->request->onlyAllow('post', 'delete');
        if ($this->Medicamento->delete()) {
            $this->Session->setFlash('Medicamento deletado com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash('Registro não foi deletado.', 'default', array('class' => 'mensagem_erro'));
        $this->redirect(array('action' => 'index'));
        
    }

}

?>

<?php
App::uses('AppController', 'Controller');

App::import('Controller', 'Users');

/**
 * Lotes Controller
 */
class LotesController extends AppController {
    
    function beforeFilter() {
        $this->set('title_for_layout', 'Lotes');
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
        $this->Lote->recursive = 0;
        $this->Paginator->settings = array(
            'conditions' => array('empresa_id' => $dadosUser['empresa_id']),
            'order' => array('descricao' => 'asc')
        );
        $this->set('lotes', $this->Paginator->paginate('Lote'));

    }

    /**
     * view method
     */
    public function view($id = null) {
        
        $this->Lote->id = $id;
        if (!$this->Lote->exists($id)) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $dadosUser = $this->Session->read();
        $empresa_id = $dadosUser['empresa_id'];
        
        $lote = $this->Lote->read(null, $id);
        if ($lote['Lote']['empresa_id'] != $empresa_id) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $this->set('lote', $lote);
        
    }

    /**
     * add method
     */
    public function add() {
        
        $dadosUser = $this->Session->read();
        $empresa_id = $dadosUser['empresa_id'];
        $this->set(compact('empresa_id'));
        
        $opcoes = array('S' => 'SIM', 'N' => 'NÃO');
        $this->set('opcoes', $opcoes);
        
        if ($this->request->is('post')) {
            $this->Lote->create();
            if ($this->Lote->save($this->request->data)) {
                $this->Session->setFlash('Lote adicionado com sucesso!', 'default', array('class' => 'mensagem_sucesso'));
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
        
        $this->Lote->id = $id;
        if (!$this->Lote->exists($id)) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $dadosUser = $this->Session->read();
        $empresa_id = $dadosUser['empresa_id'];
        
        $opcoes = array('S' => 'SIM', 'N' => 'NÃO');
        $this->set('opcoes', $opcoes);
        
        $lote = $this->Lote->read(null, $id);
        if ($lote['Lote']['empresa_id'] != $empresa_id) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Lote->id = $id;
            if ($this->Lote->save($this->request->data)) {
                $this->Session->setFlash('Lote alterado com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Registro não foi alterado. Por favor tente novamente.', 'default', array('class' => 'mensagem_erro'));
            }
        } else {
            $this->request->data = $lote;
        }
        
    }

    /**
     * delete method
     */
    public function delete($id = null) {
        
        $this->Lote->id = $id;
        if (!$this->Lote->exists()) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $this->request->onlyAllow('post', 'delete');
        if ($this->Lote->delete()) {
            $this->Session->setFlash('Lote deletado com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash('Registro não foi deletado.', 'default', array('class' => 'mensagem_erro'));
        $this->redirect(array('action' => 'index'));
        
    }

}

?>

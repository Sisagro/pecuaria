<?php

App::uses('AppController', 'Controller');

class HoldingsController extends AppController {
    
    function beforeFilter() {
        $this->set('title_for_layout', 'Holdings');
    }
    
    public $paginate = array(
        'order' => array('nome' => 'asc')
    );
    
    public function index() {
        $this->Holding->recursive = 0;
        $this->set('holdings', $this->paginate());
    }

    public function view($id = null) {
        $this->Holding->id = $id;
        if (!$this->Holding->exists()) {
            throw new NotFoundException(__('Invalid holding'));
        }
        $this->set('holding', $this->Holding->read(null, $id));
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Holding->create();
            $this->request->data['Holding']['validade'] = substr($this->request->data['datepicker'],6,4) . "-" . substr($this->request->data['datepicker'],3,2) . "-" . substr($this->request->data['datepicker'],0,2) . " 00:00:00";
            if ($this->Holding->save($this->request->data)) {
                $this->Session->setFlash('Holding adicionada com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Registro não foi salvo. Por favor tente novamente.', 'default', array('class' => 'mensagem_erro'));
            }
        }
    }

    public function edit($id = null) {
        $this->Holding->id = $id;
        if (!$this->Holding->exists()) {
            throw new NotFoundException(__('Invalid holding'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['Holding']['validade'] = substr($this->request->data['datepicker'],6,4) . "-" . substr($this->request->data['datepicker'],3,2) . "-" . substr($this->request->data['datepicker'],0,2) . " 00:00:00";
            if ($this->Holding->save($this->request->data)) {
                $this->Session->setFlash('Holding alterada com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Registro não foi alterado. Por favor tente novamente.', 'default', array('class' => 'mensagem_erro'));
            }
        } else {
            $this->request->data = $this->Holding->read(null, $id);
        }
    }

    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Holding->id = $id;
        if (!$this->Holding->exists()) {
            throw new NotFoundException(__('Invalid holding'));
        }
        if ($this->Holding->delete()) {
            $this->Session->setFlash('Holding deletada com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash('Registro não foi deletada.', 'default', array('class' => 'mensagem_erro'));
        $this->redirect(array('action' => 'index'));
    }

}
<?php
App::uses('AppController', 'Controller');

/**
 * Menus Controller
 */
class MenusController extends AppController {
    
    function beforeFilter() {
        $this->set('title_for_layout', 'Menus');
    }
    
    
    public $paginate = array(
        'order' => array('menu' => 'asc', 'ordem' => 'asc')
    );
    
    /**
     * index method
     */
    public function index() {
        $this->Menu->recursive = 0;
        $this->set('menus', $this->paginate());
    }

    /**
     * view method
     */
    public function view($id = null) {
        if (!$this->Menu->exists($id)) {
            throw new NotFoundException(__('Invalid menu'));
        }
        $options = array('conditions' => array('Menu.' . $this->Menu->primaryKey => $id));
        $this->set('menu', $this->Menu->find('first', $options));
    }

    /**
     * add method
     */
    public function add() {
        
        $opcoes = array(1 => 'SIM', 2 => 'NAO');
        $this->set('opcoes', $opcoes);
        
        if ($this->request->is('post')) {
            if ($this->request->data['Menu']['mostramenu'] == 2) {
                $this->Menu->validator()->remove('menu');
                $this->Menu->validator()->remove('ordem');
            }
            $this->Menu->create();
            if ($this->Menu->save($this->request->data)) {
                $this->Session->setFlash('Menu adicionado com sucesso!', 'default', array('class' => 'mensagem_sucesso'));
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
        $this->Menu->id = $id;
        if (!$this->Menu->exists($id)) {
            throw new NotFoundException(__('Menu inválido'));
        }
        
        $opcoes = array(1 => 'SIM', 2 => 'NAO');
        $this->set('opcoes', $opcoes);
        
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Menu->save($this->request->data)) {
                $this->Session->setFlash('Menu alterado com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Registro não foi alterado. Por favor tente novamente.', 'default', array('class' => 'mensagem_erro'));
            }
        } else {
            $this->request->data = $this->Menu->read(null, $id);
        }
    }

    /**
     * delete method
     */
    public function delete($id = null) {
        $this->Menu->id = $id;
        if (!$this->Menu->exists()) {
            throw new NotFoundException(__('Menu inválido'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Menu->delete()) {
            $this->Session->setFlash('Menu deletado com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash('Registro não foi deletado.', 'default', array('class' => 'mensagem_erro'));
        $this->redirect(array('action' => 'index'));
    }

}

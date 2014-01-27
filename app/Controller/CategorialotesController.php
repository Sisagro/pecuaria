<?php
App::uses('AppController', 'Controller');

App::import('Controller', 'Users');

/**
 * Categorialotes Controller
 */
class CategorialotesController extends AppController {
    
    function beforeFilter() {
        $this->set('title_for_layout', 'Montagem de lotes');
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
        $this->Categorialote->recursive = 0;
        $this->Paginator->settings = array(
            'conditions' => array('Lote.empresa_id' => $dadosUser['empresa_id']),
            'order' => array('Lote.descricao' => 'asc', 'Categoria.descricao' => 'asc'),
        );
        $this->set('categorialotes', $this->Paginator->paginate('Categorialote'));

    }
    
    /**
     * add method
     */
    public function add() {
        
        $dadosUser = $this->Session->read();
        $empresa_id = $dadosUser['empresa_id'];
        $dadosUser['Auth']['User']['holding_id'];
        
        $lotes = $this->Categorialote->Lote->find('list', array(
            'fields' => array('id', 'descricao'), 
            'conditions' => array('empresa_id' => $dadosUser['empresa_id']),
            'order' => array('descricao' => 'asc')
        ));
        $this->set(compact('lotes'));
        
        $this->loadModel('Especy');
        $especies = $this->Especy->find('list', array(
            'fields' => array('id', 'descricao'), 
            'conditions' => array('holding_id' => $dadosUser['Auth']['User']['holding_id']),
            'order' => array('descricao' => 'asc')
        ));
        $this->set(compact('especies'));
        
        $potreiros = $this->Categorialote->Potreiro->find('list', array(
            'fields' => array('id', 'descricao'), 
            'conditions' => array('empresa_id' => $dadosUser['empresa_id']),
            'order' => array('descricao' => 'asc')
        ));
        $this->set(compact('potreiros'));
        
        if ($this->request->is('post')) {
            $this->Categorialote->create();
            if ($this->Categorialote->save($this->request->data)) {
                $this->Session->setFlash('Montagem do lote realizada com sucesso!', 'default', array('class' => 'mensagem_sucesso'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Registro não foi salvo. Por favor tente novamente.', 'default', array('class' => 'mensagem_erro'));
            }
        }
        
    }
    
}

?>

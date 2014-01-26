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
    
}

?>

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
            'order' => array('Lote.descricao' => 'asc', 'Categoria.descricao' => 'asc', 'Potreiro.descricao' => 'asc'),
        );
        $this->set('categorialotes', $this->Paginator->paginate('Categorialote'));

    }
    
    /**
     * view method
     */
    public function view($id = null) {
        
        $this->Categorialote->id = $id;
        if (!$this->Categorialote->exists($id)) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $dadosUser = $this->Session->read();
        $empresa_id = $dadosUser['empresa_id'];
        
        $categorialote = $this->Categorialote->read(null, $id);
        
        if ($categorialote['Lote']['empresa_id'] != $empresa_id) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $this->set('item', $categorialote);
        
    }
    
    /**
     * add method
     */
    public function add() {
        
        $dadosUser = $this->Session->read();
        
        $lotes = $this->Categorialote->Lote->find('list', array(
            'fields' => array('id', 'descricao'), 
            'conditions' => array('empresa_id' => $dadosUser['empresa_id']),
            'order' => array('descricao' => 'asc')
        ));
        $this->set(compact('lotes'));
        
        $potreiros = $this->Categorialote->Potreiro->find('list', array(
            'fields' => array('id', 'descricao'), 
            'conditions' => array('empresa_id' => $dadosUser['empresa_id']),
            'order' => array('descricao' => 'asc')
        ));
        $this->set(compact('potreiros'));
        
        if ($this->request->is('post')) {
            $this->Categorialote->create();
            if ($this->Categorialote->saveAll($this->request->data)) {
                $this->Session->setFlash('Montagem do lote realizada com sucesso!', 'default', array('class' => 'mensagem_sucesso'));
                $this->redirect(array('action' => 'index'));
            } else {
                $errors = $this->Categorialote->validationErrors;
                if (isset($errors['erro'][0]['message'])) {
                    $this->Session->setFlash('Registro não foi salvo. ' . $errors['erro'][0]['message'], 'default', array('class' => 'mensagem_erro'));
                } else {
                    $this->Session->setFlash('Registro não foi salvo. Por favor tente novamente.', 'default', array('class' => 'mensagem_erro'));
                }
            }
        }
        
    }
    
    
    
    /**
     * delete method
     */
    public function delete($id = null) {
        
        $this->Categorialote->id = $id;
        if (!$this->Categorialote->exists()) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $this->request->onlyAllow('post', 'delete');
        if ($this->Categorialote->delete()) {
            $this->Session->setFlash('Montagem de lote deletado com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
            $this->redirect(array('action' => 'index'));
        }
        if(!$this->Session->check('Message.flash')) {
            $this->Session->setFlash('Registro não foi deletado.', 'default', array('class' => 'mensagem_erro'));
        } 
        $this->redirect(array('action' => 'index'));
        
    }
    
    
    /**
     * Funções ajax
     */
    
    public function buscaId($chave, $loteid) {
        $this->layout = 'ajax';
        if (array_key_exists("categoria_id", $this->request->data[$chave])) {
            $catID = $this->request->data[$chave]['categoria_id'];
        }
        
        $id = $this->Categorialote->find('list', array(
                    'fields' => array('id', 'id'),
                    'conditions' => array(
                        'categoria_id' => $catID,
                        'lote_id' => $loteid,
                    ),
                ));
        
        $this->set('id', $id);
    }
    
    public function buscaAnimaisLote($chave, $loteid) {
        $this->layout = 'ajax';
        if (array_key_exists("categoria_id", $this->request->data[$chave])) {
            $catID = $this->request->data[$chave]['categoria_id'];
        }
        
        $animaislote = $this->Categorialote->find('all', array(
                    'conditions' => array(
                        'categoria_id' => $catID,
                        'lote_id' => $loteid,
                    ),
                ));
        
        $animais = array();
        
        foreach($animaislote[0]['Animai'] as $key => $subcat){ 
            $id = $subcat['id'];
            $animais[$id] = $subcat['descricao'];
        }
        
        $this->set('animais', $animais);
    }
    
}

?>

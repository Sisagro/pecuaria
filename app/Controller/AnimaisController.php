<?php
App::uses('AppController', 'Controller');

App::import('Controller', 'Users');

/**
 * Animais Controller
 */
class AnimaisController extends AppController {
    
    function beforeFilter() {
        $this->set('title_for_layout', 'Animais');
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
        $this->Animai->recursive = 0;
        $this->Paginator->settings = array(
            'conditions' => array('empresa_id' => $dadosUser['empresa_id']),
            'order' => array('Especy.descricao' => 'asc')
        );
        $this->set('animais', $this->Paginator->paginate('Animai'));

    }
    
    /**
     * view method
     */
    public function view($id = null) {
        
        $this->Animai->id = $id;
        if (!$this->Animai->exists($id)) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $dadosUser = $this->Session->read();
        $empresa_id = $dadosUser['empresa_id'];
        
        $animal = $this->Animai->read(null, $id);
        if ($animal['Animai']['empresa_id'] != $empresa_id) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $this->set('animal', $animal);
        
    }
    
    
    /**
     * add method
     */
    public function add() {
        
        $dadosUser = $this->Session->read();
        $empresa_id = $dadosUser['empresa_id'];
        $this->set(compact('empresa_id'));
        
        $sexos = array('M' => 'MACHO', 'F' => 'FÊMEA');
        $this->set('sexos', $sexos);
        
        $status = array('A' => 'ATIVO', 'I' => 'INATIVO');
        $this->set('status', $status);
        
        $especies = $this->Animai->Especy->find('list', array(
            'fields' => array('id', 'descricao'), 
            'conditions' => array('holding_id' => $dadosUser['Auth']['User']['holding_id']),
            'order' => array('descricao' => 'asc')
        ));
        $this->set(compact('especies'));
        
        $grausangues = $this->Animai->Grausangue->find('list', array(
            'fields' => array('id', 'descricao'), 
            'conditions' => array('holding_id' => $dadosUser['Auth']['User']['holding_id']),
            'order' => array('descricao' => 'asc')
        ));
        $this->set(compact('grausangues'));
        
        $causabaixas = $this->Animai->Causabaixa->find('list', array(
            'fields' => array('id', 'descricao'), 
            'conditions' => array('holding_id' => $dadosUser['Auth']['User']['holding_id']),
            'order' => array('descricao' => 'asc')
        ));
        $this->set(compact('causabaixas'));
        
        if ($this->request->is('post')) {
            $this->Animai->create();
            if ($this->Animai->save($this->request->data)) {
                $this->Session->setFlash('Animal adicionado com sucesso!', 'default', array('class' => 'mensagem_sucesso'));
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
        
        $this->Animai->id = $id;
        if (!$this->Animai->exists($id)) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $dadosUser = $this->Session->read();
        $empresa_id = $dadosUser['empresa_id'];
        $this->set('empresa_id', $empresa_id);
        
        $animal = $this->Animai->read(null, $id);
        if ($animal['Animai']['empresa_id'] != $empresa_id) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $sexos = array('M' => 'MACHO', 'F' => 'FÊMEA');
        $this->set('sexos', $sexos);
        
        $status = array('A' => 'ATIVO', 'I' => 'INATIVO');
        $this->set('status', $status);
        
        $categorias = $this->Animai->Categoria->find('list', array(
            'fields' => array('id', 'descricao'), 
            'conditions' => array('especie_id' => $animal['Animai']['especie_id']),
            'order' => array('descricao' => 'asc')
        ));
        $this->set(compact('categorias'));
        
        $grausangues = $this->Animai->Grausangue->find('list', array(
            'fields' => array('id', 'descricao'), 
            'conditions' => array('holding_id' => $dadosUser['Auth']['User']['holding_id']),
            'order' => array('descricao' => 'asc')
        ));
        $this->set(compact('grausangues'));
        
        $causabaixas = $this->Animai->Causabaixa->find('list', array(
            'fields' => array('id', 'descricao'), 
            'conditions' => array('holding_id' => $dadosUser['Auth']['User']['holding_id']),
            'order' => array('descricao' => 'asc')
        ));
        $this->set(compact('causabaixas'));
        
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Animai->id = $id;
            if ($this->Animai->save($this->request->data)) {
                $this->Session->setFlash('Animal alterado com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Registro não foi alterado. Por favor tente novamente.', 'default', array('class' => 'mensagem_erro'));
            }
        } else {
            $this->request->data = $animal;
        }
        
    }

    /**
     * delete method
     */
    public function delete($id = null) {
        
        $this->Animai->id = $id;
        if (!$this->Animai->exists()) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $this->request->onlyAllow('post', 'delete');
        if ($this->Animai->delete()) {
            $this->Session->setFlash('Animal deletado com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash('Registro não foi deletado.', 'default', array('class' => 'mensagem_erro'));
        $this->redirect(array('action' => 'index'));
        
    }
    
    /**
     * Funções ajax
     */
    
    public function buscaAnimais($chave) {
        $this->layout = 'ajax';
        if (array_key_exists("categoria_id", $this->request->data[$chave])) {
            $catID = $this->request->data[$chave]['categoria_id'];
        }
        
        $this->loadModel('Animallote');
        $db = $this->Animallote->getDataSource();
        $subQuery = $db->buildStatement(
            array(
                'fields'     => array('Animallote.animai_id'),
                'table'      => $db->fullTableName($this->Animallote),
                'alias'      => 'Animallote',
                'limit'      => null,
                'offset'     => null,
                'joins'      => array(),
                'conditions' => null,
                'order'      => null,
                'group'      => null
            ),
            $this->Animallote
        );
        $subQuery = ' Animai.id NOT IN (' . $subQuery . ') ';
        $subQuery = 'categoria_id = ' . $catID . ' AND ' . $subQuery;
        $subQueryExpression = $db->expression($subQuery);

        $conditions[] = $subQueryExpression;
        
        $this->Animai->recursive = -1;
        $animais = $this->Animai->find('list', array(
            'fields' => array('id', 'descricao'),
            'conditions' => $conditions,
            ));
        
        $this->set('animais', $animais);

    }
    
    
}

?>

<?php
App::uses('AppController', 'Controller');

App::import('Controller', 'Users');

/**
 * Categorias Controller
 */
class CategoriasController extends AppController {
    
    function beforeFilter() {
        $this->set('title_for_layout', 'Categorias');
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
        $this->Categoria->recursive = 0;
        $this->Paginator->settings = array(
            'conditions' => array('Especy.holding_id' => $dadosUser['Auth']['User']['holding_id']),
            'order' => array('Especy.descricao' => 'asc', 'Categoria.descricao' => 'asc')
        );
        $this->set('categorias', $this->Paginator->paginate('Categoria'));
    }
    
    /**
     * view method
     */
    public function view($id = null) {
        
        $this->Categoria->id = $id;
        if (!$this->Categoria->exists()) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $dadosUser = $this->Session->read();
        $holding_id = $dadosUser['Auth']['User']['Holding']['id'];
        $categoria = $this->Categoria->read(null, $id);
        if ($categoria['Especy']['holding_id'] != $holding_id) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $this->set('categoria', $categoria);
        
    }

    /**
     * add method
     */
    public function add() {
        
        $dadosUser = $this->Session->read();
        $especies = $this->Categoria->Especy->find('list', array(
            'fields' => array('id', 'descricao'), 
            'conditions' => array('holding_id' => $dadosUser['Auth']['User']['holding_id']),
            'order' => array('descricao' => 'asc')
        ));
        $this->set(compact('especies'));
        
        $opcoes = array('M' => 'Macho', 'F' => 'Fêmea');
        $this->set('opcoes', $opcoes);
        
        if ($this->request->is('post')) {
            $this->Categoria->create();
            if ($this->Categoria->save($this->request->data)) {
                $this->Session->setFlash('Categoria adicionada com sucesso!', 'default', array('class' => 'mensagem_sucesso'));
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
        
        $this->Categoria->id = $id;
        if (!$this->Categoria->exists()) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $dadosUser = $this->Session->read();
        $holding_id = $dadosUser['Auth']['User']['Holding']['id'];
        $categoria = $this->Categoria->read(null, $id);
        if ($categoria['Especy']['holding_id'] != $holding_id) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $especies = $this->Categoria->Especy->find('list', array(
            'fields' => array('id', 'descricao'), 
            'conditions' => array('holding_id' => $holding_id),
            'order' => array('descricao' => 'asc')
        ));
        $this->set(compact('especies'));
        
        $opcoes = array('M' => 'Macho', 'F' => 'Fêmea');
        $this->set('opcoes', $opcoes);
        
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Categoria->save($this->request->data)) {
                $this->Session->setFlash('Categoria alterada com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Registro não foi alterado. Por favor tente novamente.', 'default', array('class' => 'mensagem_erro'));
            }
        } else {
            $this->request->data = $categoria;
        }
        
    }

    /**
     * delete method
     */
    public function delete($id = null) {
        
        $this->Categoria->id = $id;
        if (!$this->Categoria->exists()) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $this->request->onlyAllow('post', 'delete');
        if ($this->Categoria->delete()) {
            $this->Session->setFlash('Categoria deletada com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash('Registro não foi deletado.', 'default', array('class' => 'mensagem_erro'));
        $this->redirect(array('action' => 'index'));
        
    }
    
    
    /**
     * Funções ajax
     */
    
    public function buscaCategorias($chave, $loteID) {
        $this->layout = 'ajax';
        if (array_key_exists("especie_id", $this->request->data[$chave])) {
            $catID = $this->request->data[$chave]['especie_id'];
        }
        
        $this->loadModel('Categorialote');
        $db = $this->Categorialote->getDataSource();
        $subQuery = $db->buildStatement(
            array(
                'fields'     => array('Categorialote.categoria_id'),
                'table'      => $db->fullTableName($this->Categorialote),
                'alias'      => 'Categorialote',
                'limit'      => null,
                'offset'     => null,
                'joins'      => array(),
                'conditions' => array('lote_id' => $loteID),
                'order'      => null,
                'group'      => null
            ),
            $this->Animallote
        );
        
        $subQuery = ' Categoria.id NOT IN (' . $subQuery . ') ';
        $subQuery = 'especie_id = ' . $catID . ' AND ' . $subQuery;
        $subQueryExpression = $db->expression($subQuery);
        
        $conditions[] = $subQueryExpression;
        
        $this->Categoria->recursive = -1;
        $categorias = $this->Categoria->find('list', array(
            'fields' => array('id', 'descricao'),
            'conditions' => $conditions,
            ));
        
        $this->set('categorias', $categorias);
    }
    
    
    public function buscaCategoriasLotes($chave) {
        $this->layout = 'ajax';
        if (array_key_exists("lote_id", $this->request->data[$chave])) {
            $catID = $this->request->data[$chave]['lote_id'];
        }
        
        $categorias = $this->Categoria->find('list', array(
                    'fields' => array('Categoria.id', 'Categoria.descricao'),
                    "joins" => array(
                        array(
                            "table" => "categorialotes",
                            "alias" => "Categorialote",
                            "type" => "INNER",
                            "conditions" => array("Categorialote.categoria_id = Categoria.id")
                        )
                    ),
                    'order' => array('Categoria.descricao' => 'asc')
                ));
        
        $this->set('categorias', $categorias);
    }
    
}

?>

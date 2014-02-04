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
            'order' => array('descricao' => 'asc')
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
        
//        $conditionsSubQuery['"User2"."status"'] = 'B';
//
//        $db = $this->User->getDataSource();
//        $subQuery = $db->buildStatement(
//            array(
//                'fields'     => array('"User2"."id"'),
//                'table'      => $db->fullTableName($this->User),
//                'alias'      => 'User2',
//                'limit'      => null,
//                'offset'     => null,
//                'joins'      => array(),
//                'conditions' => $conditionsSubQuery,
//                'order'      => null,
//                'group'      => null
//            ),
//            $this->User
//        );
//        $subQuery = ' "User"."id" NOT IN (' . $subQuery . ') ';
//        $subQueryExpression = $db->expression($subQuery);
//
//        $conditions[] = $subQueryExpression;
//
//        $this->User->find('all', compact('conditions'));
        
        echo "<option value=\"\"> -- {$loteID} --</option>";
        $categorias = $this->Categoria->find('list' , array('order' => 'descricao ASC','fields' => array('id', 'descricao'),'conditions' => array('especie_id' => $catID)));
        $this->set('categorias', $categorias);
    }
    
}

?>

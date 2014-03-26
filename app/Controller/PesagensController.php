<?php

App::uses('AppController', 'Controller');

App::import('Controller', 'Users');

App::import('Vendor', 'PHPJasperXML/ReportToPDF');

/**
 * Pesagens Controller
 */
class PesagensController extends AppController {
    
    function beforeFilter() {
        $this->set('title_for_layout', 'Pesagem');
    }
    
    public function isAuthorized($user) {
        $Users = new UsersController;
        return $Users->validaAcesso($this->Session->read(), $this->request->controller);
        return parent::isAuthorized($user);
    }
    
    public function imprimir() {
        
        ReportToPDF::generateReport('', 'rpt2_grafico1.jrxml', '2', 'Pesagens');
        
//        ReportToPDF::generateReport(array('ID' => 6), 'teste.jrxml');
        
    }
    
    /**
     * index method
     */
    public function index() {
        
        $dadosUser = $this->Session->read();
        $this->Pesagen->recursive = 2;
        $this->Paginator->settings = array(
            'conditions' => array('Pesagen.empresa_id' => $dadosUser['empresa_id']),
            'order' => array('dtpesagem' => 'desc'),
        );
        $this->set('itens', $this->Paginator->paginate('Pesagen'));
        
    }
    
    
    /**
     * view method
     */
    public function view($id = null) {
        
        $this->Pesagen->id = $id;
        if (!$this->Pesagen->exists($id)) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $dadosUser = $this->Session->read();
        $empresa_id = $dadosUser['empresa_id'];
        
        $this->Pesagen->recursive = 2;
        $pesagem = $this->Pesagen->read(null, $id);
        
        if ($pesagem['Pesagen']['empresa_id'] != $empresa_id) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $this->set('item', $pesagem);
        
    }
    
    
    /**
     * add method
     */
    public function add() {
        
        $dadosUser = $this->Session->read();
        
        $this->set('usuario', $dadosUser['Auth']['User']['id']);
        
        $this->set('empresa', $dadosUser['empresa_id']);
        
        $lotes = $this->Pesagen->Categorialote->find('list', array(
            'fields' => array('Lote.id', 'Lote.descricao'),
            "joins" => array(
                array(
                    "table" => "lotes",
                    "alias" => "Lote",
                    "type" => "INNER",
                    "conditions" => array("Categorialote.lote_id = Lote.id",
                                          "Lote.empresa_id = " . $dadosUser['empresa_id'])
                )
            ),
            'order' => array('Lote.descricao' => 'asc')
        ));
        
        $this->set(compact('lotes'));
        
        if ($this->request->is('post')) {
            
//            debug($this->request->data); die();
            
            $this->Pesagen->create();
            if ($this->Pesagen->saveAll($this->request->data)) {
                $this->Session->setFlash('Pesagem criada com sucesso!', 'default', array('class' => 'mensagem_sucesso'));
                $this->redirect(array('action' => 'index'));
            } else {
                $errors = $this->Pesagen->validationErrors;
                if (isset($errors['erro'][0]['message'])) {
                    $this->Session->setFlash('Registro não foi salvo. ' . $errors['erro'][0]['message'], 'default', array('class' => 'mensagem_erro'));
                } else {
                    $this->Session->setFlash('Registro não foi salvo. Por favor tente novamente.', 'default', array('class' => 'mensagem_erro'));
                }
            }
        }
        
    }
    
    
    /**
     * edit method
     */
    public function edit($id = null) {
        
        $this->Pesagen->id = $id;
        if (!$this->Pesagen->exists()) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $dadosUser = $this->Session->read();
        $empresa_id = $dadosUser['empresa_id'];
        $pesagem = $this->Pesagen->read(null, $id);
        if ($pesagem['Pesagen']['empresa_id'] != $empresa_id) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        if ($this->request->is('post') || $this->request->is('put')) {
            
            if ($this->Pesagen->saveField('peso', $this->request->data['Pesagen']['peso']) && $this->Pesagen->saveField('dtpesagem', $this->request->data['Pesagen']['dtpesagem'])) {
                $this->Session->setFlash('Pesagem alterada com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Registro não foi alterado. Por favor tente novamente.', 'default', array('class' => 'mensagem_erro'));
            }
        } else {
            $this->request->data = $pesagem;
        }
        
    }
    
    
    /**
     * delete method
     */
    public function delete($id = null) {
        
        $this->Pesagen->id = $id;
        if (!$this->Pesagen->exists()) {
            $this->Session->setFlash('Registro não encontrado.', 'default', array('class' => 'mensagem_erro'));
            $this->redirect(array('action' => 'index'));
        }
        
        $this->request->onlyAllow('post', 'delete');
        if ($this->Pesagen->delete()) {
            $this->Session->setFlash('Pesagem deletada com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash('Registro não foi deletado.', 'default', array('class' => 'mensagem_erro'));
        $this->redirect(array('action' => 'index'));
        
    }

}
    
?>

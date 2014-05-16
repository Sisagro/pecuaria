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
    
    /**
     * imprimir method
     */
    public function imprimir() {
        
        $dadosUser = $this->Session->read();                
        
        $tprelatorio = array(1 => 'Sintético', 2 => 'Analítico');
        $this->set('tprelatorio', $tprelatorio);
        
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
            
            if (empty($this->request->data['Relatorio']['lote_id'])) {
                $lote = 0;
            } else {
                $lote = $this->request->data['Relatorio']['lote_id'];
            }
            
            if (empty($this->request->data['Relatorio']['categoria_id'])) {
                $categoria = 0;
            } else {
                $categoria = $this->request->data['Relatorio']['categoria_id'];
            }            
                        
            $params = array(
                'empresa_id' => $dadosUser['empresa_id'],
                'lote_id' => $lote,
                'categoria_id' => $categoria,
                'nomedaempresa' => $dadosUser['nomeEmpresa'],
                'nomedousuario' => $dadosUser['Auth']['User']['nome'],
                'data' => date("d/m/Y"),
            );           
                    
//            debug($this->request->data['Relatorio']['tprelatorio']); die();
                        
            if ($this->request->data['Relatorio']['tprelatorio'] == 1) {
                ReportToPDF::generateReport($params, 'pesagem_lote_sintetico.jrxml', '1', 'Eventosanitarios');
            } else {            
                ReportToPDF::generateReport($params, 'pesagem_lote_analitico.jrxml', '1', 'Eventosanitarios');
            }
                                   
        }
        
    }
    
    /**
     * index method
     */
    public function index() {
        
        $dadosUser = $this->Session->read();
        
        $this->Pesagen->recursive = 2;
        
        // busca espécies cadastradas
        $this->Pesagen->Categorialote->Categoria->Especy->recursive = -1;
        $especies = $this->Pesagen->Categorialote->Categoria->Especy->find('list', array('order' => 'descricao ASC', 'fields' => array('id', 'descricao'), 'conditions' => array('holding_id' => $dadosUser['Auth']['User']['holding_id'])));
        $this->set('especies', $especies);
        
        // Sexos
        $sexos = array('M' => 'MACHO', 'F' => 'FÊMEA');
        $this->set('sexos', $sexos);
        
        // Categorias
        $filtroCategorias = array('' => '-- Categorias --');
        
        // Lotes
        $this->Pesagen->Categorialote->Lote->recursive = -1;
        $lotes = $this->Pesagen->Categorialote->Lote->find('list', array('order' => 'descricao ASC', 'fields' => array('id', 'descricao'), 'conditions' => array('empresa_id' => $dadosUser['empresa_id'], 'ativo' => 'S')));
        
        
        $this->Filter->addFilters(
            array(
                'filter1' => array(
                    'Categorialote.categoria_id' => array(
                        'select' => $filtroCategorias
                    ),
                ),
                'filter2' => array(
                    'Categorialote.lote_id' => array(
                        'select' => $lotes
                    ),
                ),
                'filter3' => array(
                    'Pesagen.dtpesagem' => array(
                        'operator' => 'BETWEEN',
                        'between' => array(
                            'text' => __(' e ', true),
                            'date' => true
                        )
                    )
                ),
            )
        );
        
        $this->Filter->setPaginate('order', array('dtpesagem' => 'desc'));
        
        $this->Filter->setPaginate('conditions', array($this->Filter->getConditions(), 'Pesagen.empresa_id' => $dadosUser['empresa_id']));
        
        $this->set('itens', $this->paginate());
        
//        $dadosUser = $this->Session->read();
//        $this->Pesagen->recursive = 2;
//        $this->Paginator->settings = array(
//            'conditions' => array('Pesagen.empresa_id' => $dadosUser['empresa_id']),
//            'order' => array('dtpesagem' => 'desc'),
//        );
//        $this->set('itens', $this->Paginator->paginate('Pesagen'));
        
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
            if ($this->Pesagen->saveField('peso', $this->request->data['Pesagen']['peso']) && $this->Pesagen->saveField('dtpesagem', $this->request->data['Pesagen']['dtpesagem']) && $this->Pesagen->saveField('observacao', $this->request->data['Pesagen']['observacao'])) {
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

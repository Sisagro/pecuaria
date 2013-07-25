<?php

App::uses('AppController', 'Controller');

/**
 * Empresas Controller
 *
 * @property Empresa $Empresa
 */
class EmpresasController extends AppController {

    function beforeFilter() {
        $this->set('title_for_layout', 'Empresas');
    }

    public $paginate = array(
        'order' => array('razaosocial' => 'asc')
    );

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Empresa->recursive = 0;
        $this->set('empresas', $this->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Empresa->exists($id)) {
            throw new NotFoundException(__('Invalid empresa'));
        }
        $options = array('conditions' => array('Empresa.' . $this->Empresa->primaryKey => $id));
        $this->set('empresa', $this->Empresa->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        
        $holding_id = 7;
        
        $opcoes = array(1 => 'MATRIZ', 2 => 'FILIAL');
        $this->set('opcoes', $opcoes);
        
        $empresas = $this->Empresa->find('list', array('fields' => array('id', 'nomefantasia'), 'conditions' => array('holding_id'=>$holding_id, "cdempmatriz" => null)));
        $this->set(compact('empresas'));
        
        if ($this->request->is('post')) {
            $this->Empresa->create();
            $separadores = array(".", "-", "/");
            $this->request->data['Empresa']['cnpj'] = str_replace($separadores, '', $this->request->data['Empresa']['cnpjEmpresa']);
            $this->request->data['Empresa']['inscestadual'] = str_replace($separadores, '', $this->request->data['Empresa']['inscEstadualEmpresa']);
            $this->request->data['Empresa']['inscmunicipal'] = str_replace($separadores, '', $this->request->data['Empresa']['inscMunicipalEmpresa']);
            if ($this->Empresa->save($this->request->data)) {
                
//                $id = $this->Empresa->getLastInsertID();
//                $this->Empresa->id = $id;
//                
//                if ($this->request->data['Empresa']['logoempresa']['error'] == 0) {
//                    $nome_arquivo = "empresa_" . $id . "." . substr($this->request->data['Empresa']['logoempresa']['type'],6,3);
//                    $arquivo = new File($this->request->data['Empresa']['logoempresa']['tmp_name'],false);
//                    $imagem = $arquivo->read();
//                    $arquivo->close();
//                    $arquivo = new File(WWW_ROOT.'img/empresas/' . $nome_arquivo, false ,0777);
//                    if($arquivo->create()) {
//                        $arquivo->write($imagem);
//                        $arquivo->close();
//                    }
//                    $this->request->data['Empresa']['img_foto'] = $nome_arquivo;
//                    $this->Empresa->save($this->request->data);
//                }
                $this->Session->setFlash('Empresa adicionada com sucesso!', 'default', array('class' => 'mensagem_sucesso'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Registro não foi salvo. Por favor tente novamente.', 'default', array('class' => 'mensagem_erro'));
            }
        }
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        $this->Empresa->id = $id;
        if (!$this->Empresa->exists($id)) {
            throw new NotFoundException(__('Invalid empresa'));
        }
        
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->request->data['Empresa']['logoempresa']['error'] == 0) {
                // Apaga a imagem antiga
                if (!empty($this->request->data['Empresa']['img_foto'])) {
                    $img_antiga = new File(WWW_ROOT.'img/empresas/' . $this->request->data['Empresa']['img_foto'], true, 0755);
                    $img_antiga->delete();
                }
                // Insere a imagem nova
                $nome_arquivo = "sup_" . $id . "." . substr($this->request->data['Empresa']['logoempresa']['type'],6,3);
                $arquivo = new File($this->request->data['Empresa']['logoempresa']['tmp_name'],false);
                $imagem = $arquivo->read();
                $arquivo->close();
                $arquivo = new File(WWW_ROOT.'img/empresas/' . $nome_arquivo, false ,0777);
                if($arquivo->create()) {
                    $arquivo->write($imagem);
                    $arquivo->close();
                }
                $this->request->data['Empresa']['img_foto'] = $nome_arquivo;
            }
            if ($this->Empresa->save($this->request->data)) {
                $this->Session->setFlash('Empresa alterada com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Registro não foi alterado. Por favor tente novamente.', 'default', array('class' => 'mensagem_erro'));
            }
        } else {
            $this->request->data = $this->Empresa->read(null, $id);
        }
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Empresa->id = $id;
        if (!$this->Empresa->exists()) {
            throw new NotFoundException(__('Invalid empresa'));
        }
        $this->request->onlyAllow('post', 'delete');
        $foto = $this->Empresa->field('img_foto');
        if ($this->Empresa->delete()) {
            if (!empty($foto)) {
                $arquivo = new File(WWW_ROOT.'img/empresas/' . $foto, true, 0755);
                $arquivo->delete();
            }
            $this->Session->setFlash('Empresa deletada com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash('Registro não foi deletado.', 'default', array('class' => 'mensagem_erro'));
        $this->redirect(array('action' => 'index'));
    }

}

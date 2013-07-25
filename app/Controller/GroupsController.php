<?php

App::uses('AppController', 'Controller');

/**
 * Groups Controller
 */
class GroupsController extends AppController {
    
    function beforeFilter() {
        $this->set('title_for_layout', 'Grupos');
    }
    
    public $paginate = array(
        'order' => array('name' => 'asc')
    );
    
    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Group->recursive = 0;
        $this->set('groups', $this->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Group->exists($id)) {
            throw new NotFoundException(__('Invalid group'));
        }
        $options = array('conditions' => array('Group.' . $this->Group->primaryKey => $id));
        $this->set('group', $this->Group->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        $holding_id = 7;
        $this->set(compact('holding_id'));
        
        $this->loadModel('Holdingmenu');
        $this->Holdingmenu->recursive = 1;
        $holdingmenu = $this->Holdingmenu->find('all', array('fields'=>array('Menu.id','Menu.nome'),'conditions'=>array('holding_id'=>$holding_id)));
        $menus = array();
        foreach($holdingmenu as $key => $subcat){
            $menus = $menus + array($subcat['Menu']['id'] => $subcat['Menu']['nome']);
        }        
        $this->set(compact('menus'));
        
        if ($this->request->is('post')) {
            $this->Group->create();
//            debug($this->request->data);
            if ($this->Group->save($this->request->data)) {
                $this->Session->setFlash('Grupo adicionado com sucesso!', 'default', array('class' => 'mensagem_sucesso'));
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
        $this->Group->id = $id;
        if (!$this->Group->exists($id)) {
            throw new NotFoundException(__('Invalid group'));
        }
        $holding_id = 7;
        $this->set(compact('holding_id'));
        
        $this->loadModel('Holdingmenu');
        $this->Holdingmenu->recursive = 1;
        $holdingmenu = $this->Holdingmenu->find('all', array('fields'=>array('Menu.id','Menu.nome'),'conditions'=>array('holding_id'=>$holding_id)));
        $menus = array();
        foreach($holdingmenu as $key => $subcat){
            $menus = $menus + array($subcat['Menu']['id'] => $subcat['Menu']['nome']);
        }        
        $this->set(compact('menus'));
        
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Group->save($this->request->data)) {
                $this->Session->setFlash('Grupo alterado com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Registro não foi alterado. Por favor tente novamente.', 'default', array('class' => 'mensagem_erro'));
            }
        } else {
            $this->request->data = $this->Group->read(null, $id);
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
        $this->Group->id = $id;
        if (!$this->Group->exists()) {
            throw new NotFoundException(__('Invalid group'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Group->delete()) {
            $this->Session->setFlash('Grupo deletado com sucesso.', 'default', array('class' => 'mensagem_sucesso'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash('Registro não foi deletado.', 'default', array('class' => 'mensagem_erro'));
        $this->redirect(array('action' => 'index'));
    }

}

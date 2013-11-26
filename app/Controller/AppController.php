<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    
    public $components = array(
        'Session',
        'Paginator',
        'Auth' => array(
            'loginRedirect' => array('controller' => 'homes', 'action' => 'index'),
            'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
            'authorize' => array('Controller')
        )
    );
    
    public function isAuthorized($user) {
        return true;
    }
    
    function beforeRender(){
        $dadosUser = $this->Session->read();
        if (!empty($dadosUser['Auth']['User'])) {
            $this->loadModel('Usergroupempresa');
            $perfil = $this->Usergroupempresa->find('all', array(
                'conditions' => array('user_id' => $dadosUser['Auth']['User']['id'], 
                                      'empresa_id' => $dadosUser['empresa_id'],
            )));
            $perfis = "";
            for ($i=0; $i < count($perfil); $i++){
                if ($i > 0) {
                    $perfis = $perfis . ",";
                }
                $perfis = $perfis . $perfil[$i]['Group']['id'];
            }
            if ($dadosUser['Auth']['User']['adminmaster'] == 1) {
                $arrayConditions = array('Group.id IN (' . $perfis . ')',
                                         'Menu.mostramenu' => 1);
            } else {
                $arrayConditions = array('Group.id IN (' . $perfis . ')',
                                         'Menu.mostramenu' => 1,
                                         array('NOT'=> array('Menu.id'=>array(1,6))));
            }
            $this->loadModel('Groupmenu');
            $this->Groupmenu->recursive = 1;
            $menuCarregado = $this->Groupmenu->find('all', array('conditions' => $arrayConditions,
                                                                 'fields' => array('Menu.id', 
                                                                                'Menu.nome', 
                                                                                'Menu.ordem', 
                                                                                'Menu.menu', 
                                                                                'Menu.controller'),
                                                                 'order' => array('Menu.menu' => 'asc',
                                                                               'Menu.ordem' => 'asc'),
                          ));
            $this->set('menuCarregado' , $menuCarregado);
        }
    }
    
//    public function appError($error) {
//        if ($error instanceof BadRequestException) {
//            $this->redirect(array('controller' => 'homes', 'action' => 'index'));
//        } elseif ($error instanceof NotFoundException) {
//            $this->Session->setFlash('Esse registro não existe ou você não tem permissões para acessá-lo.', 'default', array('class' => 'mensagem_erro'));
//            $this->redirect(array('controller' => 'homes', 'action' => 'index'));
//        } else {
//            $this->redirect(array('controller' => 'homes', 'action' => 'index'));
//        }
//    }
    
}

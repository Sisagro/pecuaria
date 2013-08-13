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
        'Auth' => array(
            'loginRedirect' => array('controller' => 'homes', 'action' => 'index'),
            'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
            'authorize' => array('Controller')
        )
    );
    
    public function isAuthorized($user) {
        
        return true;
//        $this->loadModel('User');
//        $teste = $this->User->find('all');
////        debug($teste);
////        die();
//        if ($this->request->params['controller'] == "users") {
//            return true;
//        } else {
//            return false;
//        }
    }
    
    function beforeRender(){
        $dadosUser = $this->Session->read();
        if (!empty($dadosUser['Auth']['User'])) {
            $this->loadModel('Usergroupempresa');
            $grupos = $this->Usergroupempresa->find('all', array(
                'fields' => array('Group.id', 'Group.name'),
                'conditions' => array('user_id' => $dadosUser['Auth']['User']['id'],
                                      'empresa_id' => $dadosUser['empresa_id'],
            )));
            $this->loadModel('Group');
            $this->Group->recursive = 1;
            $menuCarregado = $this->Group->findById($grupos[0]['Group']['id']);
            $this->set('menuCarregado' , $menuCarregado['Menu']);
        }
    }
    
}

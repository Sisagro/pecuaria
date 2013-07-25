<?php

App::uses('AppModel', 'Model');

App::uses('AuthComponent', 'Controller/Component');

/**
 * User Model
 *
 */
class User extends AppModel {
    
    /**
     * Rules before save
     * 
     */
    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
        return true;
    }
    
    
    /**
     * Validation rules
     */
    public $validate = array(
        'email' => array(
            'email' => array(
                'rule' => array('email'),
            ),
        ),
        'password' => array(
            'notempty' => array(
                'rule' => array('notempty'),
            ),
        ),
        'nome' => array(
            'notempty' => array(
                'rule' => array('notempty'),
            ),
        ),
        'sobrenome' => array(
            'notempty' => array(
                'rule' => array('notempty'),
            ),
        ),
        'holding_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            ),
        ),
        'adminmaster' => array(
            'notempty' => array(
                'rule' => array('notempty'),
            ),
        ),
        'adminholding' => array(
            'notempty' => array(
                'rule' => array('notempty'),
            ),
        ),
    );

    /**
     * belongsTo associations
     *
     */
    public $belongsTo = array(
        'Holding' => array(
            'className' => 'Holding',
            'foreignKey' => 'holding_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    /**
     * hasMany associations
     *
     */
    public $hasMany = array(
        'Usergroupempresa' => array(
            'className' => 'Usergroupempresa',
            'foreignKey' => 'user_id',
            'dependent' => false
        )
    );

}

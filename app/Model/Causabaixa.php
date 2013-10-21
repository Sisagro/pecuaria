<?php

App::uses('AppModel', 'Model');

/**
 * Causabaixa Model
 * 
 */
class Causabaixa extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'nome' => array(
            'notempty' => array(
                'rule' => array('notempty'),
            ),
        ),
        'empresa_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            ),
        )
    );

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Empresa' => array(
            'className' => 'Empresa',
            'foreignKey' => 'empresa_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );


}

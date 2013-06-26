<?php

App::uses('AppModel', 'Model');

/**
 * Holding Model
 *
 */
class Holding extends AppModel {

    /**
     * Validation rules
     */
    public $validate = array(
        'nome' => array(
            'notempty' => array(
                'rule' => array('notempty'),
            ),
        ),
        'responsavel' => array(
            'notempty' => array(
                'rule' => array('notempty'),
            ),
        ),
        'contato' => array(
            'notempty' => array(
                'rule' => array('notempty'),
            ),
        ),
        'datepicker' => array(
            'notempty' => array(
                'rule' => array('notempty'),
            ),
        ),
    );
    
    /**
     * hasMany associations
     */
    public $hasMany = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'holding_id',
            'dependent' => false,
        ),
        'Empresa' => array(
            'className' => 'Empresa',
            'foreignKey' => 'holding_id',
            'dependent' => false,
        )
    );

}

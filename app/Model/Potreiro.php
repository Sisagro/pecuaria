<?php

App::uses('AppModel', 'Model');

/**
 * Potreiro Model
 * 
 */
class Potreiro extends AppModel {

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
        ),
        'area_potreiro' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                'rule' => array('notempty'),
            ),
            'maximo' => array(
                'rule'    => array('maxLength', '10'),
                'message' => 'Máximo 9.999.999.999',
            )
        ),
        'area_lavoura' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                'rule' => array('notempty'),
            ),
            'maximo' => array(
                'rule'    => array('maxLength', '10'),
                'message' => 'Máximo 9.999.999.999',
            )
            
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

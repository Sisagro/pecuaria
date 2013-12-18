<?php

App::uses('AppModel', 'Model');

/**
 * Especie Model
 * 
 */
class Especy extends AppModel {
    
    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'descricao' => array(
            'notempty' => array(
                'rule' => array('notempty'),
            ),
            'maximo' => array(
                'rule'    => array('maxLength', '100'),
                'message' => 'Máximo 100 caracteres',
            )
        ),
        'holding_id' => array(
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
        'Holding' => array(
            'className' => 'Holding',
            'foreignKey' => 'holding_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
    
}
?>

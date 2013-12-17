<?php

App::uses('AppModel', 'Model');

/**
 * Potreiro Model
 * 
 */
class Medicamento extends AppModel {

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
        'grpeventosanitario_id' => array(
            'notempty' => array(
                'rule' => array('notempty'),
            ),
        ),
        
    );
    
    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Grpeventosanitario' => array(
            'className' => 'Grpeventosanitario',
            'foreignKey' => 'grpeventosanitario_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );


}

?>

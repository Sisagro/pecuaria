<?php

App::uses('AppModel', 'Model');

/**
 * Potreiro Model
 * 
 */
class Raca extends AppModel {

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
        'abreviatura' => array(
            'maximo' => array(
                'rule'    => array('maxLength', '300'),
                'message' => 'Máximo 300 caracteres',
                'allowEmpty' => true
            )
        ),
        'especie_id' => array(
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
        'Especy' => array(
            'className' => 'Especy',
            'foreignKey' => 'especie_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
    
    /**
     * hasMany associations
     */
    public $hasMany = array(
        'Pelagen' => array(
            'className' => 'Pelagen',
            'foreignKey' => 'raca_id',
            'dependent' => false,
        ),
    );


}

?>

<?php

App::uses('AppModel', 'Model');

/**
 * Categoria Model
 * 
 */
class Categoria extends AppModel {

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
                'rule'    => array('maxLength', '20'),
                'message' => 'Máximo 300 caracteres',
                'allowEmpty' => true
            )
        ),
        'idade_min' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                'allowEmpty' => true
            ),
        ),
        'idade_max' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                'allowEmpty' => true
            ),
        ),
        'sexo' => array(
            'notempty' => array(
                'rule' => array('notempty'),
            ),
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

}

?>

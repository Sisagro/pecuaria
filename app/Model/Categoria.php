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
            'validaIdadeMinima' => array (
                'rule' => array('validaIdadeMinima'),
                'message' => 'Idade mínima deve ser menor que a idade máxima.'
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
     * Regras de validação
     *
     */
    public function validaIdadeMinima($check) {
        
        if(empty($this->data['Categoria']['idade_min']) || empty($this->data['Categoria']['idade_max'])) {
            return false;
        }
        
        if($this->data['Categoria']['idade_min'] >= $this->data['Categoria']['idade_max']) {
            return false;
        }
        
        return true;
    }
    
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

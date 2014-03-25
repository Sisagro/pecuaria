<?php

App::uses('AppModel', 'Model');

/**
 * Potreiro Model
 * 
 */
class Eventomelhoracampo extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(        
        'melhoracampo_id' => array(
            'Numerico' => array(
                'rule' => array('notempty'),
                'message' => 'Este campo deve ser informado.',
            ),
        ),
        'empresa_id' => array(
            'Numerico' => array(
                'rule' => array('notempty'),
                'message' => 'Este campo deve ser informado.',
            ),
        ),
        'potreiro_id' => array(
            'Numerico' => array(
                'rule' => array('notempty'),
                'message' => 'Este campo deve ser informado.',
            ),
        ),
        'dtmelhoria' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Informe uma data.',
            ),
        ),    
    );
    
    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Melhoracampo' => array(
            'className' => 'Melhoracampo',
            'foreignKey' => 'melhoracampo_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),        
        'Potreiro' => array(
            'className' => 'Potreiro',
            'foreignKey' => 'potreiro_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    /**
     * hasMany associations
     */
    public $hasMany = array(
        'Alimentacao' => array(
            'className' => 'Alimentacao',
            'foreignKey' => 'eventomelhoracampo_id',
            'dependent' => true,
        ),       
    );
        
    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['dtmelhoria'])) {
                $this->data[$this->alias]['dtmelhoria'] = $this->formataDataHora($this->data[$this->alias]['dtmelhoria'], 'EN');
        }
        if (isset($this->data[$this->alias]['dtvalidade'])) {
                $this->data[$this->alias]['dtvalidade'] = $this->formataDataHora($this->data[$this->alias]['dtvalidade'], 'EN');
        }
    return true;
    }
    
    public function afterFind($dados, $primary = false) {
        foreach ($dados as $key => $value) {
        if (!empty($value["Eventomelhoracampo"]["dtmelhoria"])) {
                $dados[$key]["Eventomelhoracampo"]["dtmelhoria"] = $this->formataData($value["Eventomelhoracampo"]["dtmelhoria"], 'PT');
            }
        if (!empty($value["Eventomelhoracampo"]["dtvalidade"])) {
                $dados[$key]["Eventomelhoracampo"]["dtvalidade"] = $this->formataData($value["Eventomelhoracampo"]["dtvalidade"], 'PT');
            }
        }
    return $dados;
    }
}
?>

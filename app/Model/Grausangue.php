<?php

App::uses('AppModel', 'Model');

/**
 * Grausangue Model
 * 
 */
class Grausangue extends AppModel {

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
        ),
        'holding_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            ),
        ),
        'abreviatura' => array(
            'maximo' => array(
                'rule'    => array('maxLength', '5'),
                'message' => 'Máximo 5 caracteres',
                'allowEmpty' => true
            )
        ),
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
    
    /**
     * hasMany associations
     */
    public $hasMany = array(
        'Animai' => array(
            'className' => 'Animai',
            'foreignKey' => 'grausangue_id',
            'dependent' => false,
        ),
    );
    
    /**
     * Validações
     */
    
    public function beforeDelete($cascade = true) {
        
        $animais = $this->Animai->find("count", array(
            "conditions" => array("grausangue_id" => $this->id)
        ));
        
        $totalRegistros = $animais;
        
        if ($totalRegistros == 0) {
            return true;
        } else {
            SessionComponent::setFlash('Registro não pode ser deletado porque possui ' . $totalRegistros . ' registro(s) associado(s).');
            return false;
        }
    }


}

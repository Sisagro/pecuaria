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
    
    /**
     * hasMany associations
     */
    public $hasMany = array(
        'Animai' => array(
            'className' => 'Animai',
            'foreignKey' => 'causabaixa_id',
            'dependent' => false,
        ),
    );

    
    /**
     * Validações
     */
    
    public function beforeDelete($cascade = true) {
        
        $animais = $this->Animai->find("count", array(
            "conditions" => array("causabaixa_id" => $this->id)
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

?>

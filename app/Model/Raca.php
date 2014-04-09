<?php

App::uses('AppModel', 'Model');

/**
 * Raça Model
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
        'caracteristica' => array(
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
    
    
    /**
     * Validações
     */
    
    public function beforeDelete($cascade = true) {
        
        $pelagens = $this->Pelagen->find("count", array(
            "conditions" => array("raca_id" => $this->id)
        ));
        
        $totalRegistros = $pelagens;
        
        if ($totalRegistros == 0) {
            return true;
        } else {
            SessionComponent::setFlash('Registro não pode ser deletado porque possui ' . $totalRegistros . ' registro(s) associado(s).');
            return false;
        }
    }


}

?>

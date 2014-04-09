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
    
    /**
     * hasMany associations
     */
    public $hasMany = array(
        'Eventosanitario' => array(
            'className' => 'Eventosanitario',
            'foreignKey' => 'medicamento_id',
            'dependent' => false,
        ),
    );
    
    
    /**
     * Validações
     */
    
    public function beforeDelete($cascade = true) {
        $eventos = $this->Eventosanitario->find("count", array(
            "conditions" => array("medicamento_id" => $this->id)
        ));
        
        $totalRegistros = $eventos;
        
        if ($totalRegistros == 0) {
            return true;
        } else {
            SessionComponent::setFlash('Registro não pode ser deletado porque possui ' . $totalRegistros . ' registro(s) associado(s).');
            return false;
        }
    }

}

?>

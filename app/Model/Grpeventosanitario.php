<?php

App::uses('AppModel', 'Model');

/**
 * Causabaixa Model
 * 
 */
class Grpeventosanitario extends AppModel {

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
        'Medicamento' => array(
            'className' => 'Medicamento',
            'foreignKey' => 'grpeventosanitario_id',
            'dependent' => false,
        ),
    );
    
    
    /**
     * Validações
     */
    
    public function beforeDelete($cascade = true) {
        
        $medicamentos = $this->Medicamento->find("count", array(
            "conditions" => array("grpeventosanitario_id" => $this->id)
        ));
        
        $totalRegistros = $medicamentos;
        
        if ($totalRegistros == 0) {
            return true;
        } else {
            SessionComponent::setFlash('Registro não pode ser deletado porque possui ' . $totalRegistros . ' registro(s) associado(s).');
            return false;
        }
    }
    

}

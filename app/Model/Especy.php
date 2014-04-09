<?php

App::uses('AppModel', 'Model');

/**
 * Especie Model
 * 
 */
class Especy extends AppModel {
    
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
        'Raca' => array(
            'className' => 'Raca',
            'foreignKey' => 'especie_id',
            'dependent' => false,
        ),
        'Categoria' => array(
            'className' => 'Categoria',
            'foreignKey' => 'especie_id',
            'dependent' => false,
        ),
        'Animai' => array(
            'className' => 'Animai',
            'foreignKey' => 'especie_id',
            'dependent' => false,
        ),
    );
    
    
    /**
     * Validações
     */
    
    public function beforeDelete($cascade = true) {
        
        $racas = $this->Raca->find("count", array(
            "conditions" => array("Raca.especie_id" => $this->id)
        ));
        
        $categorias = $this->Categoria->find("count", array(
            "conditions" => array("Categoria.especie_id" => $this->id)
        ));
        
        $animais = $this->Animai->find("count", array(
            "conditions" => array("Animai.especie_id" => $this->id)
        ));
        
        $totalRegistros = $racas + $categorias + $animais;
        
        if ($totalRegistros == 0) {
            return true;
        } else {
            SessionComponent::setFlash('Registro não pode ser deletado porque possui ' . $totalRegistros . ' registro(s) associado(s).');
            return false;
        }
    }
    
}
?>

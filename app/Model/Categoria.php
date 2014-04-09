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
    
    
    /**
     * hasMany associations
     */
    public $hasMany = array(
        'Animai' => array(
            'className' => 'Animai',
            'foreignKey' => 'categoria_id',
            'dependent' => false,
        ),
        'Categorialote' => array(
            'className' => 'Categorialote',
            'foreignKey' => 'categoria_id',
            'dependent' => false,
        ),
    );
    
    
    /**
     * Validações
     */
    
    public function beforeDelete($cascade = true) {
        
        $animais = $this->Animai->find("count", array(
            "conditions" => array("Animai.categoria_id" => $this->id)
        ));
        
        $lotes = $this->Categorialote->find("count", array(
            "conditions" => array("Categorialote.categoria_id" => $this->id)
        ));
        
        $totalRegistros = $animais + $lotes;
        
        if ($totalRegistros == 0) {
            return true;
        } else {
            SessionComponent::setFlash('Registro não pode ser deletado porque possui ' . $totalRegistros . ' registro(s) associado(s).');
            return false;
        }
    }

}

?>

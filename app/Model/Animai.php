<?php

App::uses('AppModel', 'Model');

/**
 * Animai Model
 * 
 */
class Animai extends AppModel {

    /**
     * Virtual fields
     */
    public $virtualFields = array(
        "descricao" => "IF (Animai.brinco = '' OR Animai.brinco IS NULL, 
                                IF(Animai.tatuagem = '' OR Animai.tatuagem IS NULL, 
                                        IF(Animai.hbbsbb = '' OR Animai.hbbsbb IS NULL, 
                                                'Animal sem identificação', 
                                                CONCAT('<b>H:</b> ' , Animai.hbbsbb)), 
                                        IF(Animai.hbbsbb = '' OR Animai.hbbsbb IS NULL, 
                                                CONCAT('<b>T:</b> ' , Animai.tatuagem), 
                                                CONCAT('<b>T:</b> ' , Animai.tatuagem, ' <b>H:</b> ', Animai.hbbsbb))
                                        ), 
                                IF(Animai.tatuagem = '' OR Animai.tatuagem IS NULL, 
                                        IF(Animai.hbbsbb = '' OR Animai.hbbsbb IS NULL, 
                                                CONCAT('<b>B:</b> ' , Animai.brinco), 
                                                CONCAT('<b>B:</b> ' , Animai.brinco, ' <b>H:</b> ', Animai.hbbsbb)), 
                                        IF(Animai.hbbsbb = '' OR Animai.hbbsbb IS NULL, 
                                                CONCAT('<b>B:</b> ' , Animai.brinco, ' <b>T:</b> ', Animai.tatuagem), 
                                                CONCAT('<b>B:</b> ' , Animai.brinco, ' <b>T:</b> ', Animai.tatuagem, ' <b>H:</b> ', Animai.hbbsbb))
                                        )
                                )"
    );

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'empresa_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            ),
        ),
        'especie_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Este campo é obrigatório.',
            ),
        ),
        'pelagen_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                'allowEmpty' => true
            ),
        ),
        'categoria_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Este campo é obrigatório.',
            ),
        ),
        'grausangue_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                'allowEmpty' => true
            ),
        ),
        'sexo' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Este campo é obrigatório.',
            ),
        ),
        'caracteristica' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Este campo não pode ser vazio.',
                'allowEmpty' => true,
                'last' => false
            ),
            'tamanho' => array(
                'rule' => array('maxLength', 300),
                'message' => 'Este campo não pode ter mais que 300 caracteres.',
                'allowEmpty' => true,
                'last' => false
            ),
        ),
        'ativo' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Este campo é obrigatório.',
            ),
        ),
        'brinco' => array(
            'alphanumeric' => array(
                'rule' => array('alphanumeric'),
                'allowEmpty' => true,
                'last' => false
            ),
            'tamanho' => array(
                'rule' => array('maxLength', 15),
                'message' => 'Este campo não pode ter mais que 15 caracteres.',
                'allowEmpty' => true
            ),
        ),
        'chipeletronico' => array(
            'alphanumeric' => array(
                'rule' => array('alphanumeric'),
                'allowEmpty' => true,
                'last' => false
            ),
            'tamanho' => array(
                'rule' => array('maxLength', 15),
                'message' => 'Este campo não pode ter mais que 15 caracteres.',
                'allowEmpty' => true
            ),
        ),
        'colareletronico' => array(
            'alphanumeric' => array(
                'rule' => array('alphanumeric'),
                'allowEmpty' => true,
                'last' => false
            ),
            'tamanho' => array(
                'rule' => array('maxLength', 15),
                'message' => 'Este campo não pode ter mais que 15 caracteres.',
                'allowEmpty' => true
            ),
        ),
        'tatuagem' => array(
            'alphanumeric' => array(
                'rule' => array('alphanumeric'),
                'allowEmpty' => true,
                'last' => false
            ),
            'tamanho' => array(
                'rule' => array('maxLength', 30),
                'message' => 'Este campo não pode ter mais que 30 caracteres.',
                'allowEmpty' => true,
            ),
        ),
        'hbbsbb' => array(
            'alphanumeric' => array(
                'rule' => array('alphanumeric'),
                'allowEmpty' => true,
                'last' => false
            ),
            'tamanho' => array(
                'rule' => array('maxLength', 20),
                'message' => 'Este campo não pode ter mais que 20 caracteres.',
                'allowEmpty' => true
            ),
        ),
        'cor' => array(
            'alphanumeric' => array(
                'rule' => array('alphanumeric'),
                'allowEmpty' => true,
                'last' => false
            ),
            'tamanho' => array(
                'rule' => array('maxLength', 6),
                'message' => 'Este campo não pode ter mais que 6 caracteres.',
                'allowEmpty' => true
            ),
        ),
        'causabaixa_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                'allowEmpty' => true
            ),
        ),
        'dtnasc' => array(
            'tamanho' => array(
                'rule' => array('maxLength', 10),
                'message' => 'Este campo não pode ter mais que 10 caracteres.',
                'allowEmpty' => true
            ),
        ),
        'dtcomprado' => array(
            'tamanho' => array(
                'rule' => array('maxLength', 10),
                'message' => 'Este campo não pode ter mais que 10 caracteres.',
                'allowEmpty' => true
            ),
        ),
    );

    
    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Empresa' => array(
            'className' => 'Empresa',
            'foreignKey' => 'empresa_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Especy' => array(
            'className' => 'Especy',
            'foreignKey' => 'especie_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Pelagen' => array(
            'className' => 'Pelagen',
            'foreignKey' => 'pelagen_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Categoria' => array(
            'className' => 'Categoria',
            'foreignKey' => 'categoria_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Grausangue' => array(
            'className' => 'Grausangue',
            'foreignKey' => 'grausangue_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Causabaixa' => array(
            'className' => 'Causabaixa',
            'foreignKey' => 'causabaixa_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
    );
    
    /**
     * hasMany associations
     */
    public $hasMany = array(
        'Animallote' => array(
            'className' => 'Animallote',
            'foreignKey' => 'animai_id',
            'dependent' => false,
        ),
    );
    
    
    /**
     * Validações
     */
    
    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['dtnasc'])) {
            $this->data[$this->alias]['dtnasc'] = $this->formataData($this->data[$this->alias]['dtnasc'], 'EN', 'N');
        }
        if (isset($this->data[$this->alias]['dtcomprado'])) {
            $this->data[$this->alias]['dtcomprado'] = $this->formataData($this->data[$this->alias]['dtcomprado'], 'EN', 'N');
        }
        return true;
    }

    public function afterFind($dados, $primary = false) {
        foreach ($dados as $key => $value) {
            if (!empty($value["Animai"]["dtnasc"])) {
                $dados[$key]["Animai"]["dtnasc"] = $this->formataData($value["Animai"]["dtnasc"], 'PT', 'N');
            }
            if (!empty($value["Animai"]["dtcomprado"])) {
                $dados[$key]["Animai"]["dtcomprado"] = $this->formataData($value["Animai"]["dtcomprado"], 'PT', 'N');
            }
        }
        return $dados;
    }
    
    public function beforeDelete($cascade = true) {
        
        $animais = $this->Animallote->find("count", array(
            "conditions" => array("animai_id" => $this->id)
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

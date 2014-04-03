<?php

App::uses('AppModel', 'Model');

/**
 * Categorialote Model
 *
 * @property Lote $Lote
 * @property Categoria $Categoria
 * @property Potreiro $Potreiro
 */
class Categorialote extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'lote_id' => array(
            'Numerico' => array(
                'rule' => array('notempty'),
                'message' => 'Este campo deve ser informado.',
            ),
        ),
        'categoria_id' => array(
            'Numerico' => array(
                'rule' => array('numeric'),
                'message' => 'Este campo deve ser informado.',
            ),
        ),
        'potreiro_id' => array(
            'Numerico' => array(
                'rule' => array('notempty'),
                'message' => 'Este campo deve ser informado.',
            ),
        ),
    );

    //The Associations below have been created with all possible keys, those that are not needed can be removed
    
    /**
     * hasMany associations
     */
    public $hasMany = array(
        'Eventosanitario' => array(
            'className' => 'Eventosanitario',
            'foreignKey' => 'categorialote_id',
            'dependent' => true,
        ),
        'Pesagen' => array(
            'className' => 'Pesagen',
            'foreignKey' => 'categorialote_id',
            'dependent' => true,
        ),
        'Eventoalimentacao' => array(
            'className' => 'Eventoalimentacao',
            'foreignKey' => 'categorialote_id',
            'dependent' => true,
        ),
    );
    
    
    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Lote' => array(
            'className' => 'Lote',
            'foreignKey' => 'lote_id',
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
        'Potreiro' => array(
            'className' => 'Potreiro',
            'foreignKey' => 'potreiro_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
    
    /**
     * hasAndBelongsToMany associations
     */
    public $hasAndBelongsToMany = array(
        'Animai' =>
            array(
                'className'             => 'Animai',
                'joinTable'             => 'animallotes',
                'foreignKey'            => 'categorialote_id',
                'associationForeignKey' => 'animai_id',
                'dependent'             => true,
            )
    );
    
    
    
    // VALIDAÇÕES
    
    public function afterValidate($options = array()) {
        if (empty($this->data['Animai']['Animai'])) {
            $this->invalidate('erro', array('message' => 'É obrigatório informar ao menos um animal.'));
            return false;
        }
        return true;
    }
    
    public function beforeDelete($cascade = true) {
        $eventos = $this->Eventosanitario->find("count", array(
            "conditions" => array("categorialote_id" => $this->id)
        ));
        $pesagens = $this->Pesagen->find("count", array(
            "conditions" => array("categorialote_id" => $this->id)
        ));
        
        $totalRegistros = $eventos + $pesagens;
        
        if ($totalRegistros == 0) {
            return true;
        } else {
            SessionComponent::setFlash('Registro não pode ser deletado porque possui ' . $totalRegistros . ' registros associados.');
            return false;
        }
    }
    
}

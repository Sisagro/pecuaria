<?php

App::uses('AppModel', 'Model');

/**
 * Pesagen Model
 *
 * @property Categorialote $Categorialote
 * @property User $User
 * @property Animalevento $Animalevento
 */
class Eventoalimentacao extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'categorialote_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Este campo é obrigatório.',
            ),
        ),
        'alimentacao_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Este campo é obrigatório.',
            ),
        ),
        'lote_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Este campo é obrigatório.',
            ),
        ),
        'categoria_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Este campo é obrigatório.',
            ),
        ),
        'dtalimentacao' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Informe uma data.',
            ),
        ),       
    );

    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Categorialote' => array(
            'className' => 'Categorialote',
            'foreignKey' => 'categorialote_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Alimentacao' => array(
            'className' => 'Alimentacao',
            'foreignKey' => 'alimentacao_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
    );
    
    /**
     * hasAndBelongsToMany associations
     */
    public $hasAndBelongsToMany = array(
        'Animai' =>
            array(
                'className'             => 'Animai',
                'joinTable'             => 'animalalimentacaos',
                'foreignKey'            => 'alimentacao_id',
                'associationForeignKey' => 'animai_id',
                'dependent'             => true,
            )
    );
    
    // VALIDAÇÕES
    
    public function afterValidate($options = array()) {
        if (isset($this->data['Animai']['Animai'])) {
            if (empty($this->data['Animai']['Animai'])) {
                $this->invalidate('erro', array('message' => 'É obrigatório informar ao menos um animal.'));
                return false;
            }
        }
        return true;
    }
    
    
    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['created'])) {
            $this->data[$this->alias]['created'] = $this->formataDataHora($this->data[$this->alias]['created'], 'EN');
        }
        if (isset($this->data[$this->alias]['modified'])) {
            $this->data[$this->alias]['modified'] = $this->formataDataHora($this->data[$this->alias]['modified'], 'EN');
        }
        if (isset($this->data[$this->alias]['dtalimentacao'])) {
            $this->data[$this->alias]['dtalimentacao'] = $this->formataDataHora($this->data[$this->alias]['dtalimentacao'], 'EN');
        }        
        return true;
    }

    public function afterFind($dados, $primary = false) {
        foreach ($dados as $key => $value) {
            if (!empty($value["Eventoalimentacao"]["created"])) {
                $dados[$key]["Eventoalimentacao"]["created"] = $this->formataDataHora($value["Eventoalimentacao"]["created"], 'PT');
            }
            if (!empty($value["Eventoalimentacao"]["modified"])) {
                $dados[$key]["Eventoalimentacao"]["modified"] = $this->formataDataHora($value["Eventoalimentacao"]["modified"], 'PT');
            }
            if (!empty($value["Eventoalimentacao"]["dtalimentacao"])) {
                $dados[$key]["Eventoalimentacao"]["dtalimentacao"] = $this->formataData($value["Eventoalimentacao"]["dtalimentacao"], 'PT');
            }
        }
        return $dados;
    }

}
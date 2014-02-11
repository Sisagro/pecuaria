<?php

App::uses('AppModel', 'Model');

/**
 * Pesagen Model
 *
 * @property Categorialote $Categorialote
 * @property User $User
 * @property Animalevento $Animalevento
 */
class Pesagen extends AppModel {

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
        'dtpesagem' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Informe uma data.',
            ),
        ),
        'peso' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Informe o peso.',
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
    );
    
    /**
     * hasAndBelongsToMany associations
     */
    public $hasAndBelongsToMany = array(
        'Animai' =>
            array(
                'className'             => 'Animai',
                'joinTable'             => 'animalpesagens',
                'foreignKey'            => 'pesagen_id',
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
        if (isset($this->data[$this->alias]['dtpesagem'])) {
            $this->data[$this->alias]['dtpesagem'] = $this->formataDataHora($this->data[$this->alias]['dtpesagem'], 'EN');
        }
        if (isset($this->data[$this->alias]['peso'])) {
            $this->data[$this->alias]['peso'] = str_replace(".", "", $this->data[$this->alias]['peso']);
            $this->data[$this->alias]['peso'] = str_replace(",", ".", $this->data[$this->alias]['peso']);
        }
        return true;
    }

    public function afterFind($dados, $primary = false) {
        foreach ($dados as $key => $value) {
            if (!empty($value["Pesagen"]["created"])) {
                $dados[$key]["Pesagen"]["created"] = $this->formataDataHora($value["Pesagen"]["created"], 'PT');
            }
            if (!empty($value["Pesagen"]["modified"])) {
                $dados[$key]["Pesagen"]["modified"] = $this->formataDataHora($value["Pesagen"]["modified"], 'PT');
            }
            if (!empty($value["Pesagen"]["dtpesagem"])) {
                $dados[$key]["Pesagen"]["dtpesagem"] = $this->formataData($value["Pesagen"]["dtpesagem"], 'PT');
            }
            if (!empty($value["Pesagen"]["peso"])) {
                $dados[$key]["Pesagen"]["peso"] = str_replace(".", ",", $value["Pesagen"]["peso"]);
            }
        }
        return $dados;
    }

}

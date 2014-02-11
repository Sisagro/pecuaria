<?php

App::uses('AppModel', 'Model');

/**
 * Eventosanitario Model
 *
 * @property Categorialote $Categorialote
 * @property User $User
 * @property Medicamento $Medicamento
 * @property Animalevento $Animalevento
 */
class Eventosanitario extends AppModel {

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
        'medicamento_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Este campo é obrigatório.',
            ),
        ),
        'dtevento' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Informe uma data.',
            ),
        ),
        'dosagem' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Informe uma dosagem.',
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
        'Medicamento' => array(
            'className' => 'Medicamento',
            'foreignKey' => 'medicamento_id',
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
                'joinTable'             => 'animaleventos',
                'foreignKey'            => 'eventosanitario_id',
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
        if (isset($this->data[$this->alias]['dtevento'])) {
            $this->data[$this->alias]['dtevento'] = $this->formataDataHora($this->data[$this->alias]['dtevento'], 'EN');
        }
        if (isset($this->data[$this->alias]['dosagem'])) {
            $this->data[$this->alias]['dosagem'] = str_replace(".", "", $this->data[$this->alias]['dosagem']);
            $this->data[$this->alias]['dosagem'] = str_replace(",", ".", $this->data[$this->alias]['dosagem']);
        }
        return true;
    }

    public function afterFind($dados, $primary = false) {
        foreach ($dados as $key => $value) {
            if (!empty($value["Eventosanitario"]["created"])) {
                $dados[$key]["Eventosanitario"]["created"] = $this->formataDataHora($value["Eventosanitario"]["created"], 'PT');
            }
            if (!empty($value["Eventosanitario"]["modified"])) {
                $dados[$key]["Eventosanitario"]["modified"] = $this->formataDataHora($value["Eventosanitario"]["modified"], 'PT');
            }
            if (!empty($value["Eventosanitario"]["dtevento"])) {
                $dados[$key]["Eventosanitario"]["dtevento"] = $this->formataData($value["Eventosanitario"]["dtevento"], 'PT');
            }
            if (!empty($value["Eventosanitario"]["dosagem"])) {
                $dados[$key]["Eventosanitario"]["dosagem"] = str_replace(".", ",", $value["Eventosanitario"]["dosagem"]);
            }
        }
        return $dados;
    }

}

<?php

App::uses('AppModel', 'Model');

/**
 * Potreiro Model
 * 
 */
class Potreiro extends AppModel {

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
        'empresa_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            ),
        ),
        'area_potreiro' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                'rule' => array('notempty'),
            ),
            'maximo' => array(
                'rule'    => array('maxLength', '13'),
                'message' => 'Máximo 999999999,0000',
            )
        ),
        'area_lavoura' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                'rule' => array('notempty'),
            ),
            'maximo' => array(
                'rule'    => array('maxLength', '14'),
                'message' => 'Máximo 9.999.999.999,0000',
            )
            
        )
    );
    
    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['area_potreiro'])) {
            $this->data[$this->alias]['area_potreiro'] = str_replace(".", "", $this->data[$this->alias]['area_potreiro']);
            $this->data[$this->alias]['area_potreiro'] = str_replace(",", ".", $this->data[$this->alias]['area_potreiro']);
        }
        if (isset($this->data[$this->alias]['area_lavoura'])) {
            $this->data[$this->alias]['area_lavoura'] = str_replace(".", "", $this->data[$this->alias]['area_lavoura']);
            $this->data[$this->alias]['area_lavoura'] = str_replace(",", ".", $this->data[$this->alias]['area_lavoura']);
        }
        return true;
    }
    
    public function afterFind($dados, $primary = false) {
        foreach ($dados as $key => $value) {
            if (!empty($value["Potreiro"]["area_potreiro"])) {
                $dados[$key]["Potreiro"]["area_potreiro"] = str_replace(".", ",", $value["Potreiro"]["area_potreiro"]);
            }
            if (!empty($value["Potreiro"]["area_lavoura"])) {
                $dados[$key]["Potreiro"]["area_lavoura"] = str_replace(".", ",", $value["Potreiro"]["area_lavoura"]);
            }
        }
        return $dados;
    }

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
        )
    );


}

<?php

App::uses('AppModel', 'Model');

/**
 * Lote Model
 * 
 */
class Lote extends AppModel {

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
        'ativo' => array(
            'notempty' => array(
                'rule' => array('notempty'),
            ),
        ),
        
    );
    
    public function beforeSave($dados, $primary = false) {
        if (isset($this->data[$this->alias]['created'])) {
            $this->data[$this->alias]['created'] = $this->formataDataSalvar($this->data[$this->alias]['created']);
        }
        if (isset($this->data[$this->alias]['modified'])) {
            $this->data[$this->alias]['modified'] = $this->formataDataSalvar($this->data[$this->alias]['modified']);
        }
        return true;
    }
    
    public function afterFind($dados, $primary = false) {
        foreach ($dados as $key => $value) {
            if (!empty($value["Lote"]["created"])) {
                $dados[$key]["Lote"]["created"] = $this->formataDataVisualizar($value["Lote"]["created"]);
            }
            if (!empty($value["Lote"]["modified"])) {
                $dados[$key]["Lote"]["modified"] = $this->formataDataVisualizar($value["Lote"]["modified"]);
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

?>

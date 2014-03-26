<?php

App::uses('AppModel', 'Model');

/**
 * Menu Model
 *
 * @property Groupmenu $Groupmenu
 */
class Plano extends AppModel {

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
//        'empresa' => array(
//            'notempty' => array(
//                'rule' => array('numeric'),
//            ),
//        ),
//        'usuario' => array(
//            'notempty' => array(
//                'rule' => array('numeric'),
//            ),
//        ),
//        'animal' => array(
//            'notempty' => array(
//                'rule' => array('numeric'),
//            ),            
//        ),
        'valor' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                'rule' => array('notempty'),
                'allowEmpty' => true,
                'message' => 'É necessário informar um valor numérico.',
                
            ),
            'maximo' => array(
                'rule'    => array('maxLength', '14'),
                'message' => 'Máximo 9.999.999.999,0000',
            )
            
        )
    );
    
    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['valor'])) {
            $this->data[$this->alias]['valor'] = str_replace(".", "", $this->data[$this->alias]['valor']);
            $this->data[$this->alias]['valor'] = str_replace(",", ".", $this->data[$this->alias]['valor']);
        }
        return true;
    }
    
    public function afterFind($dados, $primary = false) {
        foreach ($dados as $key => $value) {
            if (!empty($value["Plano"]["valor"])) {
                $dados[$key]["Plano"]["valor"] = str_replace(".", ",", $value["Plano"]["valor"]);
            }
        }
        return $dados;
    }
    
    /**
     * hasMany associations
     
    public $hasMany = array(
        'Holdingmenu' => array(
            'className' => 'Holdingmenu',
            'foreignKey' => 'menu_id',
            'dependent' => false,
        )
    );
*/
}

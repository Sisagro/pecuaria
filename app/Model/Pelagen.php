<?php

App::uses('AppModel', 'Model');

/**
 * Pelagem Model
 * 
 */
class Pelagen extends AppModel {

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
        'raca_id' => array(
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
        'Raca' => array(
            'className' => 'Raca',
            'foreignKey' => 'raca_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );


}

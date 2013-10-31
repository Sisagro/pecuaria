<?php

App::uses('AppModel', 'Model');

/**
 * Pelagem Model
 * 
 */
class Pelagem extends AppModel {

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
        'Holding' => array(
            'className' => 'Holding',
            'foreignKey' => 'raca_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );


}

<?php

App::uses('AppModel', 'Model');

/**
 * Animallote Model
 *
 * @property Categorialote $Categorialote
 * @property Animai $Animai
 */
class Animallote extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'animai_id' => array(
            'Selecione' => array(
                'rule' => array('multiple', array(
                        'min' => 1
                    )),
                'message' => 'Seleciona ao menos um animal.',
            ),
        ),
    );

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
        'Animai' => array(
            'className' => 'Animai',
            'foreignKey' => 'animai_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

}

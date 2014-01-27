<?php

App::uses('AppModel', 'Model');

/**
 * Categorialote Model
 *
 * @property Lote $Lote
 * @property Categoria $Categoria
 * @property Potreiro $Potreiro
 * @property Animallote $Animallote
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
        'Animai.animai_id' => array(
            'Selecione' => array(
                'rule' => array('multiple', array(
                                'min' => 1
                            )),
                'message' => 'Seleciona ao menos um animal.',
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
                //'order'                 => 'Animai.menu, Menu.ordem',
            )
    );
    
    
    
    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'Animallote' => array(
            'className' => 'Animallote',
            'foreignKey' => 'categorialote_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );

}

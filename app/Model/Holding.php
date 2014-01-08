<?php

App::uses('AppModel', 'Model');

/**
 * Holding Model
 *
 */
class Holding extends AppModel {

    /**
     * Validation rules
     */
    public $validate = array(
        'nome' => array(
            'notempty' => array(
                'rule' => array('notempty'),
            ),
        ),
        'datepicker' => array(
            'notempty' => array(
                'rule' => array('notempty'),
            ),
        ),
    );
    
    /**
     * hasMany associations
     */
    public $hasMany = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'holding_id',
            'dependent' => false,
        ),
        'Empresa' => array(
            'className' => 'Empresa',
            'foreignKey' => 'holding_id',
            'dependent' => false,
        ),
        'Holdingmenu' => array(
            'className' => 'Holdingmenu',
            'foreignKey' => 'holding_id',
            'dependent' => false,
        ),
        'Causabaixa' => array(
            'className' => 'Causabaixa',
            'foreignKey' => 'holding_id',
            'dependent' => false,
        ),
        'Grausangue' => array(
            'className' => 'Grausangue',
            'foreignKey' => 'holding_id',
            'dependent' => false,
        ),
        'Grpeventosanitario' => array(
            'className' => 'Grpeventosanitario',
            'foreignKey' => 'holding_id',
            'dependent' => false,
        ),
        'Paise' => array(
            'className' => 'Paise',
            'foreignKey' => 'holding_id',
            'dependent' => false,
        ),
        'Especy' => array(
            'className' => 'Especy',
            'foreignKey' => 'holding_id',
            'dependent' => false,
        ),
        'Estado' => array(
            'className' => 'Estado',
            'foreignKey' => 'holding_id',
            'dependent' => false,
        ),
        'Cidade' => array(
            'className' => 'Cidade',
            'foreignKey' => 'holding_id',
            'dependent' => false,
        ),
    );
    
    /**
     * hasAndBelongsToMany associations
     */
    public $hasAndBelongsToMany = array(
        'Menu' =>
            array(
                'className'             => 'Menu',
                'joinTable'             => 'holdingmenus',
                'foreignKey'            => 'holding_id',
                'associationForeignKey' => 'menu_id',
                'order'                 => 'Menu.menu, Menu.ordem',
            )
    );

}

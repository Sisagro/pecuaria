<?php

App::uses('AppModel', 'Model');

/**
 * Group Model
 *
 * @property Holding $Holding
 * @property Groupmenu $Groupmenu
 * @property Usergroupempresa $Usergroupempresa
 */
class Group extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'name' => array(
            'notempty' => array(
                'rule' => array('notempty'),
            ),
        ),
        'holding_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            ),
        ),
    );

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Holding' => array(
            'className' => 'Holding',
            'foreignKey' => 'holding_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    /**
     * hasMany associations
     */
    public $hasMany = array(
        'Usergroupempresa' => array(
            'className' => 'Usergroupempresa',
            'foreignKey' => 'group_id',
            'dependent' => false,
        )
    );
    
    /**
     * hasAndBelongsToMany associations
     */
    public $hasAndBelongsToMany = array(
        'Menu' =>
            array(
                'className'             => 'Menu',
                'joinTable'             => 'groupmenus',
                'foreignKey'            => 'group_id',
                'associationForeignKey' => 'menu_id',
                'order'                 => 'Menu.menu, Menu.ordem',
            )
    );

}

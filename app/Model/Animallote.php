<?php

App::uses('AppModel', 'Model');

/**
 * Categoria Model
 * 
 */
class Animallote extends AppModel {
    
    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Animai' => array(
            'className' => 'Animai',
            'foreignKey' => 'animai_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
    
}
?>

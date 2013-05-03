<?php

class Estado extends AppModel {
    
    public $validate = array(
        'nome' => array(
            'rule' => 'notEmpty',
            'message' => 'Este campo não pode ser vazio.'
        ),
    );
    
}

?>

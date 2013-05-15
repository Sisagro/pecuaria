<?php

class Estado extends AppModel {
    
    public $validate = array(
        'nome' => array(
            'rule' => 'notEmpty',
            'message' => 'Este campo não pode ser vazio.'
        ),
        'sigla' => array(
            'notEmpty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Este campo não pode ser vazio.'
            ),
            'tamanho' => array(                
                'message' => 'Este campo deve possuir 2 caracteres.'
            )
        ),
    );    
}

?>

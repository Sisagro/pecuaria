<?php
echo $this->Html->link($this->Html->image("botoes/retornar.png", array("alt" => "Retornar", "title" => "Retornar")), array('action' => 'index'), array('escape' => false));
?>
<br>
<br>
<?php echo $this->Form->create('Pelagen'); ?>
<fieldset>
    <?php
    echo $this->Form->input('descricao');
    echo $this->Form->input('especie_id', array ('id' => 'especieID', 'type' => 'select','options' => $especies, 'label' => 'Espécie', 'empty' => ' -- Selecione a espécie -- '));
    echo $this->Form->input('raca_id', array('id' => 'racaID', 'type' => 'select', 'label' => 'Raças'));
    ?>
</fieldset>
<?php echo $this->Form->end(__('Adicionar')); ?>
<?php

$this->Js->get('#especieID')->event(
    'change',
    $this->Js->request(
        array('controller' => 'Racas', 'action' => 'buscaRacas', 'Pelagen'),
        array(  'update' => '#racaID',
                'async' => true,
		'method' => 'post',
		'dataExpression'=>true,
		'data'=> $this->Js->serializeForm(array(
			'isForm' => true,
			'inline' => true
			)),
            )
    )
);

?>
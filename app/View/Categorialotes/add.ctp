<?php
echo $this->Html->link($this->Html->image("botoes/retornar.png", array("alt" => "Retornar", "title" => "Retornar")), array('action' => 'index'), array('escape' => false, 'onclick' => 'history.go(-1); return false;'));
?>
<br>
<br>
<?php echo $this->Form->create('Categorialote'); ?>
<fieldset>
    <?php
    //debug($lotes);
    echo $this->Form->input('lote_id', array ('id' => 'loteID', 'type' => 'select', 'options' => $lotes, 'label' => 'Lote', 'empty' => '-- Selecione o lote --'));
    echo $this->Form->input('especie_id', array ('id' => 'especieID', 'type' => 'select', 'options' => $especies, 'label' => 'Espécie', 'empty' => '-- Selecione a espécie --'));
    echo $this->Form->input('categoria_id', array('id' => 'categoriaID', 'type' => 'select', 'label' => 'Categoria', 'empty' => ' '));
    echo $this->Form->input('potreiro_id', array ('id' => 'potreiroID', 'type' => 'select', 'options' => $potreiros, 'label' => 'Potreiro', 'empty' => '-- Selecione o potreiro --'));
    echo $this->Form->input('Animai.animai_id',array('id' => 'animalID', 'title' => 'CTRL + Click (para selecionar mais de um)', 'label'=>'Selecione os animais', 'type'=>'select', 'multiple'=>true));
    ?>
</fieldset>
<?php echo $this->Form->end(__('Montar lote')); ?>

<?php
$this->Js->get('#especieID')->event(
    'change',
    $this->Js->request(
        array('controller' => 'Categorias', 'action' => 'buscaCategorias', 'Categorialote'),
        array(  'update' => '#categoriaID',
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
$this->Js->get('#categoriaID')->event(
    'change',
    $this->Js->request(
        array('controller' => 'Animais', 'action' => 'buscaAnimais', 'Categorialote'),
        array(  'update' => '#animalID',
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




<?php
echo $this->Html->link($this->Html->image("botoes/retornar.png", array("alt" => "Retornar", "title" => "Retornar")), array('action' => 'index'), array('escape' => false));
?>
<br>
<br>
<?php echo $this->Form->create('Estado'); ?>
<fieldset>
    <?php
    echo $this->Form->input('nome');
    echo $this->Form->input('pais_id', array ('id' => 'estado', 'type' => 'select','options' => $paises, 'label' => 'Estados', 'empty' => ''));
    ?>
</fieldset>
<?php echo $this->Form->end(__('Editar')); ?>

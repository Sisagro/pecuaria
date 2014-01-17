<?php
echo $this->Html->link($this->Html->image("botoes/retornar.png", array("alt" => "Retornar", "title" => "Retornar")), array('action' => 'index'), array('escape' => false, 'onclick' => 'history.go(-1); return false;'));
?>
<br>
<br>
<?php echo $this->Form->create('Raca'); ?>
<fieldset>
    <?php
    echo $this->Form->input('descricao', array('label' => 'Descrição'));
    echo $this->Form->input('especie_id', array ('id' => 'especie', 'type' => 'select','options' => $especies, 'label' => 'Espécies', 'empty' => ''));
    echo $this->Form->input('caracteristica', array('label' => 'Característica'));
    ?>
</fieldset>
<?php echo $this->Form->end(__('Editar')); ?>
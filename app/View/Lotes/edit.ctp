<?php
echo $this->Html->link($this->Html->image("botoes/retornar.png", array("alt" => "Retornar", "title" => "Retornar")), array('action' => 'index'), array('escape' => false));
?>
<br>
<br>
<?php echo $this->Form->create('Lote'); ?>
<fieldset>
    <?php
    echo $this->Form->input('descricao');
    echo $this->Form->input('ativo', array ('id' => 'ativo', 'type' => 'select','options' => $opcoes, 'label' => 'Ativo'));
    ?>
</fieldset>
<?php echo $this->Form->end(__('Editar')); ?>
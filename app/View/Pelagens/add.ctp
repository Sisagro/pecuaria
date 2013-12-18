<?php
echo $this->Html->link($this->Html->image("botoes/retornar.png", array("alt" => "Retornar", "title" => "Retornar")), array('action' => 'index'), array('escape' => false));
?>
<br>
<br>
<?php echo $this->Form->create('Pelagen'); ?>
<fieldset>
    <?php
    echo $this->Form->input('descricao');
    echo $this->Form->input('raca_id', array ('id' => 'raca', 'type' => 'select','options' => $racas, 'label' => 'Raças', 'empty' => ''));
    ?>
</fieldset>
<?php echo $this->Form->end(__('Adicionar')); ?>
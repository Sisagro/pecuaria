<?php
echo $this->Html->link($this->Html->image("botoes/retornar.png", array("alt" => "Retornar", "title" => "Retornar")), array('action' => 'index'), array('escape' => false, 'onclick' => 'history.go(-1); return false;'));
?>
<br>
<br>
<?php echo $this->Form->create('Grausangue'); ?>
<fieldset>
    <?php
    echo $this->Form->input('descricao', array('label' => 'Descrição', 'type' => 'text'));
    echo $this->Form->input('abreviatura', array('maxlength' => '5', 'type' => 'text'));
    echo $this->Form->input('holding_id', array('type' => 'hidden', 'value' => $holding_id));
    ?>
</fieldset>
<?php echo $this->Form->end(__('Adicionar')); ?>
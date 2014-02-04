<?php
echo $this->Html->link($this->Html->image("botoes/retornar.png", array("alt" => "Retornar", "title" => "Retornar")), array('action' => 'index'), array('escape' => false, 'onclick' => 'history.go(-1); return false;'));
?>
<br>
<br>
<?php echo $this->Form->create('Grausangue'); ?>
<fieldset>
    <?php
    echo $this->Form->input('descricao', array('label' => 'Descrição', 'type' => 'text'));
    echo $this->Form->input('abreviatura', array('maxlenght' => '5', 'type' => 'text'));
    ?>
</fieldset>
<?php echo $this->Form->end(__('Editar')); ?>

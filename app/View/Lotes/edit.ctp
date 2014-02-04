<?php
echo $this->Html->link($this->Html->image("botoes/retornar.png", array("alt" => "Retornar", "title" => "Retornar")), array('action' => 'index'), array('escape' => false, 'onclick' => 'history.go(-1); return false;'));
?>
<br>
<br>
<?php echo $this->Form->create('Lote'); ?>
<fieldset>
    <?php
    echo $this->Form->input('descricao');
    echo $this->Form->input('ativo', array ('id' => 'ativo', 'type' => 'select','options' => $opcoes, 'label' => 'Ativo'));
    echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => $user_id));
    ?>
</fieldset>
<?php echo $this->Form->end(__('Editar')); ?>
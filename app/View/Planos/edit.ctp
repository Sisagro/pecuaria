<?php
echo $this->Html->link($this->Html->image("botoes/retornar.png", array("alt" => "Retornar", "title" => "Retornar")), array('action' => 'index'), array('escape' => false, 'onclick' => 'history.go(-1); return false;'));
?>
<br>
<br>
<?php echo $this->Form->create('Plano'); ?>
<fieldset>
    <?php
    echo $this->Form->input('descricao');
    echo $this->Form->input('usuario', array ('id' => 'itemusuario'));
    echo $this->Form->input('empresa', array ('id' => 'itemempresa'));
    echo $this->Form->input('animal', array ('id' => 'itemanimal'));
    echo $this->Form->input('valor', array('id' => 'plano',  'type' => 'text', 'label' => 'Valor', 'maxlength' => '10'));
    ?>
</fieldset>
<?php echo $this->Form->end(__('Editar')); ?>
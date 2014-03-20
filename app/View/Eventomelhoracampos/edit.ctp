<?php
echo $this->Html->link($this->Html->image("botoes/retornar.png", array("alt" => "Retornar", "title" => "Retornar")), array('action' => 'index'), array('escape' => false, 'onclick' => 'history.go(-1); return false;'));
?>
<br>
<br>
<?php echo $this->Form->create('Eventomelhoracampo'); ?>
<fieldset>
    <?php
    echo $this->Form->input('melhoracampo_id', array ('id' => 'melhoracampo', 'type' => 'select','options' => $melhoracampos, 'label' => 'Melhoria de campo', 'empty' => ''));
//    echo $this->Form->input('potreiro_id', array ('id' => 'potreiro', 'type' => 'select','options' => $potreiros, 'label' => 'Potreiro', 'empty' => ''));
    echo $this->Form->input('dtmelhoria', array('id' => 'dtevento', 'class' => 'data', 'type' => 'text', 'label' => 'Data da melhoria'));
    echo $this->Form->input('dtvalidade', array('id' => 'dtevento', 'class' => 'data', 'type' => 'text', 'label' => 'Validade da melhoria'));
    echo $this->Form->input('observacao', array('id' => 'observacao', 'type' => 'textarea',  'label' => 'Observação'));
    ?>
</fieldset>
<?php echo $this->Form->end(__('Editar')); ?>
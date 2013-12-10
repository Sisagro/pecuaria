<?php
echo $this->Html->link($this->Html->image("botoes/retornar.png", array("alt" => "Retornar", "title" => "Retornar")), array('action' => 'index'), array('escape' => false));
?>
<br>
<br>
<?php echo $this->Form->create('Medicamento'); ?>
<fieldset>
    <?php
    echo $this->Form->input('descricao', array('label' => 'Descrição'));
    echo $this->Form->input('palavrachave', array('label' => 'Palavra chave'));
    echo $this->Form->input('principioativo', array('label' => 'Princípio ativo'));
    echo $this->Form->input('grpeventosanitario_id', array ('id' => 'eventoSanitario', 'type' => 'select','options' => $grpeventosanitarios, 'label' => 'Evento sanitário', 'empty' => ''));
    ?>
</fieldset>
<?php echo $this->Form->end(__('Editar')); ?>
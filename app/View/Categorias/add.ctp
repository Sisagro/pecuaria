<?php
echo $this->Html->link($this->Html->image("botoes/retornar.png", array("alt" => "Retornar", "title" => "Retornar")), array('action' => 'index'), array('escape' => false));
?>
<br>
<br>
<?php echo $this->Form->create('Categoria'); ?>
<fieldset>
    <?php
    echo $this->Form->input('descricao', array('label' => 'Descrição'));
    echo $this->Form->input('especie_id', array ('id' => 'especie', 'type' => 'select','options' => $especies, 'label' => 'Espécies', 'empty' => ''));
    echo $this->Form->input('sexo', array ('id' => 'sexo', 'type' => 'select','options' => $opcoes, 'label' => 'Sexo', 'empty' => ''));
    echo $this->Form->input('abreveatura', array('label' => 'Abreveatura'));
    echo $this->Form->input('idade_max', array('label' => 'Idade máxima (Meses)'));
    ?>
</fieldset>
<?php echo $this->Form->end(__('Adicionar')); ?>
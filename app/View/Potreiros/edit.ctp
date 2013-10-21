<?php
echo $this->Html->link($this->Html->image("botoes/retornar.png", array("alt" => "Retornar", "title" => "Retornar")), array('action' => 'index'), array('escape' => false));
?>
<br>
<br>
<?php echo $this->Form->create('Potreiro'); ?>
<fieldset>
    <?php
    echo $this->Form->input('nome');
    echo $this->Form->input('area_potreiro', array('label' => 'Área potreiro'));
    echo $this->Form->input('area_lavoura', array('label' => 'Área lavoura'));
    ?>
</fieldset>
<?php echo $this->Form->end(__('Editar')); ?>

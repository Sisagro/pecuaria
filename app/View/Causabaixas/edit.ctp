<?php
echo $this->Html->link($this->Html->image("botoes/retornar.png", array("alt" => "Retornar", "title" => "Retornar")), array('action' => 'index'), array('escape' => false));
?>
<br>
<br>
<?php echo $this->Form->create('Causabaixa'); ?>
<fieldset>
    <?php
    echo $this->Form->input('nome');
    ?>
</fieldset>
<?php echo $this->Form->end(__('Editar')); ?>

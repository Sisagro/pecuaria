<?php
echo $this->Html->link($this->Html->image("botoes/retornar.png", array("alt" => "Retornar", "title" => "Retornar")), array('action' => 'index'), array('escape' => false));
?>
<br>
<br>
<?php echo $this->Form->create('User'); ?>
<fieldset>
    <?php
    echo $this->Form->input('id');
    echo $this->Form->input('nome');
    echo $this->Form->input('sobrenome');
    echo $this->Form->input('email');
    echo $this->Form->input('password');
    echo $this->Form->input('holding_id', array ('type' => 'select','options' => $holdings, 'label' => 'Holding'));
    ?>
</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
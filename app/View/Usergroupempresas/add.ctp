<?php
echo $this->Html->link($this->Html->image("botoes/retornar.png", array("alt" => "Retornar", "title" => "Retornar")), array('action' => 'index'), array('escape' => false));
?>
<br>
<br>
<?php echo $this->Form->create('Usergroupempresa'); ?>
<fieldset>
    <?php
    echo $this->Form->input('user_id', array ('id' => 'userID', 'type' => 'select','options' => $usuarios, 'label' => 'Usuários', 'empty' => ''));
    echo $this->Form->input('group_id', array ('id' => 'groupID', 'type' => 'select', 'options' => $grupos, 'label' => 'Grupos', 'empty' => ''));
    echo $this->Form->input('empresaboot', array ('id' => 'empresaBoot', 'type' => 'select', 'options' => $opcoes, 'label' => 'Empresa Boot', 'empty' => ''));
    echo $this->Form->input('empresa_id', array('value' => '8', 'type' => 'hidden'));
    ?>
</fieldset>
<?php echo $this->Form->end(__('Adicionar')); ?>

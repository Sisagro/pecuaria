<?php
echo $this->Html->link($this->Html->image("botoes/retornar.png", array("alt" => "Retornar", "title" => "Retornar")), array('action' => 'index'), array('escape' => false));
echo $this->Form->postLink($this->Html->image('botoes/excluir.png', array('alt' => 'Exluir', 'title' => 'Exluir')), array('action' => 'delete', $holding['Holding']['id']), array('escape' => false), __('Você realmete deseja apagar esse item?'));
?>
<br>
<br>
<p>
Holding: 
<?php echo $holding['Holding']['nome']; ?>
<br>
Acesso ao sistema até: 
<?php echo date('d/m/Y', strtotime($holding['Holding']['validade'])); ?>
<br>
Última modifiação: 
<?php echo date('d/m/Y', strtotime($holding['Holding']['modified'])); ?>
<br>
Criação: 
<?php echo date('d/m/Y', strtotime($holding['Holding']['created'])); ?>
<br>
Menus: 
<br>
<?php $i = 0;?>
<?php foreach ($holding['Menu'] as $menu): ?>

    &nbsp;&nbsp;&nbsp;&nbsp; <?php echo $menu['nome']; ?> <br>

    <?php $i++; ?>
<?php endforeach; ?>
</p>


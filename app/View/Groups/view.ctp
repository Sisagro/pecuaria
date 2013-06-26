<?php
echo $this->Html->link($this->Html->image("botoes/retornar.png", array("alt" => "Retornar", "title" => "Retornar")), array('action' => 'index'), array('escape' => false));
echo $this->Form->postLink($this->Html->image('botoes/excluir.png', array('alt' => 'Exluir', 'title' => 'Exluir')), array('action' => 'delete', $group['Group']['id']), array('escape' => false), __('Você realmete deseja apagar esse item?'));
?>
<br>
<br>
<p>
    Grupo: 
    <?php echo $group['Group']['name']; ?>
    <br>
    Última modifiação: 
    <?php echo date('d/m/Y', strtotime($group['Group']['modified'])); ?>
    <br>
    Criação: 
    <?php echo date('d/m/Y', strtotime($group['Group']['created'])); ?>
    <br>
    <?php $i = 0; ?>

    Menus: <br>

    <?php foreach ($group['Menu'] as $menu): ?>

        &nbsp;&nbsp;&nbsp;&nbsp; <?php echo $menu['nome']; ?> <br>

        <?php $i++; ?>
    <?php endforeach; ?>
    <?php unset($group); ?>
</p>


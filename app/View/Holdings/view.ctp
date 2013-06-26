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
Responsável: 
<?php echo $holding['Holding']['responsavel']; ?>
<br>
Contato: 
<?php echo $holding['Holding']['contato']; ?>
<br>
Acesso ao sistema até: 
<?php echo date('d/m/Y', strtotime($holding['Holding']['validade'])); ?>
<br>
Última modifiação: 
<?php echo date('d/m/Y', strtotime($holding['Holding']['modified'])); ?>
<br>
Criação: 
<?php echo date('d/m/Y', strtotime($holding['Holding']['created'])); ?>
</p>


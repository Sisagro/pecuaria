<?php
echo $this->Html->link($this->Html->image("botoes/retornar.png", array("alt" => "Retornar", "title" => "Retornar")), array('action' => 'index'), array('escape' => false));
echo $this->Form->postLink($this->Html->image('botoes/excluir.png', array('alt' => 'Exluir', 'title' => 'Exluir')), array('action' => 'delete', $user['User']['id']), array('escape' => false), __('Você realmete deseja apagar esse item?'));
?>
<br>
<br>
<p>
Nome: 
<?php echo $user['User']['nome'] . " " . $user['User']['sobrenome']; ?>
<br>
E-mail: 
<?php echo $user['User']['email']; ?>
<br>
Holding:
<?php echo $this->Html->link($user['Holding']['nome'], array('controller' => 'holdings', 'action' => 'view', $user['Holding']['id'])); ?>
<br>
Último acesso:
<?php echo date('d/m/Y', strtotime($user['User']['ultimoacesso'])); ?>
<br>
Última modifiação: 
<?php echo date('d/m/Y', strtotime($user['User']['modified'])); ?>
<br>
Criação: 
<?php echo date('d/m/Y', strtotime($user['User']['created'])); ?>
</p>
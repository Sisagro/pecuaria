<?php
echo $this->Html->link($this->Html->image("botoes/retornar.png", array("alt" => "Retornar", "title" => "Retornar")), array('action' => 'index'), array('escape' => false));
echo $this->Form->postLink($this->Html->image('botoes/excluir.png', array('alt' => 'Exluir', 'title' => 'Exluir')), array('action' => 'delete', $user['User']['id']), array('escape' => false), __('Você realmete deseja apagar esse item?'));
?>
<br>
<br>
<p>
<strong> Nome: </strong>
<?php echo $user['User']['nome'] . " " . $user['User']['sobrenome']; ?>
<br>
<strong> E-mail: </strong>
<?php echo $user['User']['email']; ?>
<br>
<strong> Holding: </strong>
<?php echo $this->Html->link($user['Holding']['nome'], array('controller' => 'holdings', 'action' => 'view', $user['Holding']['id'])); ?>
<br>
<strong> Último acesso: </strong>
<?php echo date('d/m/Y', strtotime($user['User']['ultimoacesso'])); ?>
<br>
<strong> Última modifiação: </strong>
<?php echo date('d/m/Y', strtotime($user['User']['modified'])); ?>
<br>
<strong> Criação: </strong>
<?php echo date('d/m/Y', strtotime($user['User']['created'])); ?>
</p>
<?php
echo $this->Html->link($this->Html->image("botoes/retornar.png", array("alt" => "Retornar", "title" => "Retornar")), array('action' => 'index'), array('escape' => false, 'onclick' => 'history.go(-1); return false;'));
echo $this->Form->postLink($this->Html->image('botoes/excluir.png', array('alt' => 'Exluir', 'title' => 'Exluir')), array('action' => 'delete', $plano['Plano']['id']), array('escape' => false), __('Você realmete deseja apagar esse item?'));
?>
<br>
<br>
<p>
<strong> Descrição: </strong>
<?php echo $plano['Plano']['descricao']; ?>
<br>
<strong> Usuários: </strong>
<?php echo $plano['Plano']['usuario']; ?>
<br>
<strong> Empresas: </strong>
<?php echo $plano['Plano']['empresa']; ?>
<br>
<strong> Animais: </strong>
<?php echo $plano['Plano']['animal']; ?>
<br>
<strong> Valor: </strong>
<?php echo $plano['Plano']['valor']; ?>
<br>
</p>
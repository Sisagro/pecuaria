<?php
echo $this->Html->link($this->Html->image("botoes/retornar.png", array("alt" => "Retornar", "title" => "Retornar")), array('action' => 'index'), array('escape' => false));
echo $this->Form->postLink($this->Html->image('botoes/excluir.png', array('alt' => 'Exluir', 'title' => 'Exluir')), array('action' => 'delete', $raca['Raca']['id']), array('escape' => false), __('Você realmete deseja apagar esse item?'));
?>
<br>
<br>
<p>
<strong> Descrição: </strong>
<?php echo $raca['Raca']['descricao']; ?>
<br>
<strong> Palavra-chave: </strong>
<?php echo $raca['Raca']['caracteristica']; ?>
<br>
<strong> Espécie: </strong>
<?php echo $raca['Especy']['descricao']; ?>
<br>
</p>

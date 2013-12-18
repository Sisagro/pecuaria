<?php
echo $this->Html->link($this->Html->image("botoes/retornar.png", array("alt" => "Retornar", "title" => "Retornar")), array('action' => 'index'), array('escape' => false));
echo $this->Form->postLink($this->Html->image('botoes/excluir.png', array('alt' => 'Exluir', 'title' => 'Exluir')), array('action' => 'delete', $categoria['Categoria']['id']), array('escape' => false), __('Você realmete deseja apagar esse item?'));
?>
<br>
<br>
<p>
<strong> Descrição: </strong>
<?php echo $categoria['Categoria']['descricao']; ?>
<br>
<strong> Espécie: </strong>
<?php echo $categoria['Especy']['descricao']; ?>
<br>
<strong> Sexo: </strong>
<?php echo $categoria['Categoria']['sexo']; ?>
<br>
<strong> Abreveatura: </strong>
<?php echo $categoria['Categoria']['abreveatura']; ?>
<br>
<strong> Idade mínima: </strong>
<?php echo $categoria['Categoria']['idade_min']; ?>
<br>
<strong> Idade máxima: </strong>
<?php echo $categoria['Categoria']['idade_max']; ?>
<br>
</p>

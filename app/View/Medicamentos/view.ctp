<?php
echo $this->Html->link($this->Html->image("botoes/retornar.png", array("alt" => "Retornar", "title" => "Retornar")), array('action' => 'index'), array('escape' => false));
echo $this->Form->postLink($this->Html->image('botoes/excluir.png', array('alt' => 'Exluir', 'title' => 'Exluir')), array('action' => 'delete', $medicamento['Medicamento']['id']), array('escape' => false), __('Você realmete deseja apagar esse item?'));
?>
<br>
<br>
<p>
<strong> Descrição: </strong>
<?php echo $medicamento['Medicamento']['descricao']; ?>
<br>
<strong> Palavra-chave: </strong>
<?php echo $medicamento['Medicamento']['palavrachave']; ?>
<br>
<strong> Princípio ativo: </strong>
<?php echo $medicamento['Medicamento']['principioativo']; ?>
<br>
<strong> Evento sanitário: </strong>
<?php echo $medicamento['Grpeventosanitario']['descricao']; ?>
<br>
</p>

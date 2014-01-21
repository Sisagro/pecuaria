<?php
echo $this->Html->link($this->Html->image("botoes/retornar.png", array("alt" => "Retornar", "title" => "Retornar")), array('action' => 'index'), array('escape' => false, 'onclick' => 'history.go(-1); return false;'));
echo $this->Form->postLink($this->Html->image('botoes/excluir.png', array('alt' => 'Exluir', 'title' => 'Exluir')), array('action' => 'delete', $lote['Lote']['id']), array('escape' => false), __('Você realmete deseja apagar esse item?'));
?>
<br>
<br>
<p>
<strong> Descrição: </strong>
<?php echo $lote['Lote']['descricao']; ?>
<br>
<strong> Ativo: </strong>
<?php if($lote['Lote']['ativo'] == "S") { echo "SIM"; } else { echo "NÃO"; } ; ?>
<br>
<strong> Data de criação: </strong>
<?php echo $lote['Lote']['created']; ?>
<br>
<strong> Última modificação: </strong>
<?php echo $lote['Lote']['modified'] . " - " . $lote['User']['nome'] . " " . $lote['User']['sobrenome']; ?>
<br>
</p>
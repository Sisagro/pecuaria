<?php
echo $this->Html->link($this->Html->image("botoes/retornar.png", array("alt" => "Retornar", "title" => "Retornar")), array('action' => 'index'), array('escape' => false, 'onclick' => 'history.go(-1); return false;'));
echo $this->Form->postLink($this->Html->image('botoes/excluir.png', array('alt' => 'Exluir', 'title' => 'Exluir')), array('action' => 'delete', $item['Alimentacao']['id']), array('escape' => false), __('Você realmete deseja apagar esse item?'));
?>
<br>
<br>
<p>
<strong> Alimentação: </strong>
<?php echo $item['Eventomelhoracampo']['Melhoracampo']['descricao']; ?>
<br>
<strong> Lote: </strong>
<?php echo $item['Categorialote']['Lote']['descricao']; ?>
<br>
<strong> Categoria: </strong>
<?php echo $item['Categorialote']['Categoria']['descricao']; ?>
<br>
<strong> Data da alimentação: </strong>
<?php echo $item['Alimentacao']['dtalimentacao']; ?>
<br>
<strong> Observação: </strong>
<?php echo $item['Alimentacao']['observacao']; ?>
<br>
<strong> Criado em: </strong>
<?php echo $item['Alimentacao']['created']; ?>
<br>
<strong> Modificado em: </strong>
<?php echo $item['Alimentacao']['modified'] . " por " . $item['User']['nome']; ?>
<br>
<strong> Animais: </strong> <br>

<?php foreach ($item['Animai'] as $animal): ?>

    &nbsp;&nbsp;&nbsp;&nbsp; <?php echo $animal['descricao']; ?> <br>

<?php endforeach; ?>
<?php unset($item); ?>
<br>
</p>
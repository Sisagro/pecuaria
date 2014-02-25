<?php
echo $this->Html->link($this->Html->image("botoes/retornar.png", array("alt" => "Retornar", "title" => "Retornar")), array('action' => 'index'), array('escape' => false, 'onclick' => 'history.go(-1); return false;'));
echo $this->Form->postLink($this->Html->image('botoes/excluir.png', array('alt' => 'Exluir', 'title' => 'Exluir')), array('action' => 'delete', $item['Categorialote']['id']), array('escape' => false), __('Você realmete deseja apagar esse item?'));
?>
<br>
<br>
<p>
<strong> Lote: </strong>
<?php echo $item['Lote']['descricao']; ?>
<br>
<strong> Categoria: </strong>
<?php echo $item['Categoria']['descricao']; ?>
<br>
<strong> Potreiro: </strong>
<?php echo $item['Potreiro']['descricao']; ?>
<br>
<strong> Observação: </strong>
<?php echo $item['Categorialote']['observacao']; ?>
<br>
<strong> Animais: </strong> <br>

<?php foreach ($item['Animai'] as $animal): ?>

    &nbsp;&nbsp;&nbsp;&nbsp; <?php echo $animal['descricao']; ?> <br>

<?php endforeach; ?>
<?php unset($item); ?>
<br>
</p>
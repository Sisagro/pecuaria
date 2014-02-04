<?php
echo $this->Html->link($this->Html->image("botoes/retornar.png", array("alt" => "Retornar", "title" => "Retornar")), array('action' => 'index'), array('escape' => false, 'onclick' => 'history.go(-1); return false;'));
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
<strong> Animais: </strong> <br>

<?php foreach ($item['Animai'] as $animal): ?>

    &nbsp;&nbsp;&nbsp;&nbsp; <?php echo $animal['descricao']; ?> <br>

<?php endforeach; ?>
<?php unset($item); ?>
<br>
</p>
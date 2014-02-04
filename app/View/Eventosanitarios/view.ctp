<?php
echo $this->Html->link($this->Html->image("botoes/retornar.png", array("alt" => "Retornar", "title" => "Retornar")), array('action' => 'index'), array('escape' => false, 'onclick' => 'history.go(-1); return false;'));
?>
<br>
<br>
<p>
<strong> Medicamento: </strong>
<?php echo $item['Medicamento']['descricao']; ?>
<br>
<strong> Dosagem: </strong>
<?php echo $item['Eventosanitario']['dosagem']; ?>
<br>
<strong> Data do evento: </strong>
<?php echo $item['Eventosanitario']['dtevento']; ?>
<br>
<strong> Observação: </strong>
<?php echo $item['Eventosanitario']['observacao']; ?>
<br>
<strong> Criado em: </strong>
<?php echo $item['Eventosanitario']['created']; ?>
<br>
<strong> Modificado em: </strong>
<?php echo $item['Eventosanitario']['modified'] . " por " . $item['User']['nome']; ?>
<br>
<strong> Animais: </strong> <br>

<?php foreach ($item['Animai'] as $animal): ?>

    &nbsp;&nbsp;&nbsp;&nbsp; <?php echo $animal['descricao']; ?> <br>

<?php endforeach; ?>
<?php unset($item); ?>
<br>
</p>
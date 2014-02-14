<?php
echo $this->Html->link($this->Html->image("botoes/retornar.png", array("alt" => "Retornar", "title" => "Retornar")), array('action' => 'index'), array('escape' => false, 'onclick' => 'history.go(-1); return false;'));
echo $this->Form->postLink($this->Html->image('botoes/excluir.png', array('alt' => 'Exluir', 'title' => 'Exluir')), array('action' => 'delete', $item['Pesagen']['id']), array('escape' => false), __('Você realmete deseja apagar esse item?'));
?>
<br>
<br>
<p>
<strong> Peso: </strong>
<?php echo $item['Pesagen']['peso']; ?>
<br>
<strong> Data do evento: </strong>
<?php echo $item['Pesagen']['dtpesagem']; ?>
<br>
<strong> Observação: </strong>
<?php echo $item['Pesagen']['observacao']; ?>
<br>
<strong> Criado em: </strong>
<?php echo $item['Pesagen']['created']; ?>
<br>
<strong> Modificado em: </strong>
<?php echo $item['Pesagen']['modified'] . " por " . $item['User']['nome']; ?>
<br>
<strong> Animais: </strong> <br>

<?php foreach ($item['Animai'] as $animal): ?>

    &nbsp;&nbsp;&nbsp;&nbsp; <?php echo $animal['descricao']; ?> <br>

<?php endforeach; ?>
<?php unset($item); ?>
<br>
</p>
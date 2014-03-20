<?php
echo $this->Html->link($this->Html->image("botoes/retornar.png", array("alt" => "Retornar", "title" => "Retornar")), array('action' => 'index'), array('escape' => false));
echo $this->Form->postLink($this->Html->image('botoes/excluir.png', array('alt' => 'Exluir', 'title' => 'Exluir')), array('action' => 'delete', $eventomelhoracampo['Eventomelhoracampo']['id']), array('escape' => false), __('Você realmete deseja apagar esse item?'));
?>
<br>
<br>
<p>
<strong> Melhoria de campo: </strong>
<?php echo $eventomelhoracampo['Melhoracampo']['descricao']; ?>
<br>
<strong> Potreiro: </strong>
<?php echo $eventomelhoracampo['Potreiro']['descricao']; ?>
<br>
<strong> Data da melhoria de campo: </strong>
<?php echo $eventomelhoracampo['Eventomelhoracampo']['dtmelhoria']; ?>
<br>
<strong> Data de validade: </strong>
<?php echo $eventomelhoracampo['Eventomelhoracampo']['dtvalidade']; ?>
<br>
<strong> Observação: </strong>
<?php echo $eventomelhoracampo['Eventomelhoracampo']['observacao']; ?>
<br>
</p>
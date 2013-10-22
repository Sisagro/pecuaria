<?php
echo $this->Html->link($this->Html->image("botoes/retornar.png", array("alt" => "Retornar", "title" => "Retornar")), array('action' => 'index'), array('escape' => false));
echo $this->Form->postLink($this->Html->image('botoes/excluir.png', array('alt' => 'Exluir', 'title' => 'Exluir')), array('action' => 'delete', $grausangue['Grausangue']['id']), array('escape' => false), __('Você realmete deseja apagar esse item?'));
?>
<br>
<br>
<p>
Descrição: 
<?php echo $grausangue['Grausangue']['descricao']; ?>
<br>
Abreviatura: 
<?php echo $grausangue['Grausangue']['abreviatura']; ?>
<br>
</p>
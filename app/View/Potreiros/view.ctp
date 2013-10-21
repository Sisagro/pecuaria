<?php
echo $this->Html->link($this->Html->image("botoes/retornar.png", array("alt" => "Retornar", "title" => "Retornar")), array('action' => 'index'), array('escape' => false));
echo $this->Form->postLink($this->Html->image('botoes/excluir.png', array('alt' => 'Exluir', 'title' => 'Exluir')), array('action' => 'delete', $causabaixa['Causabaixa']['id']), array('escape' => false), __('Você realmete deseja apagar esse item?'));
?>
<br>
<br>
<p>
Nome: 
<?php echo $potreiro['Potreiro']['nome']; ?>
<br>
Área potreiro: 
<?php echo $potreiro['Potreiro']['area_potreiro']; ?>
<br>
Área lavoura: 
<?php echo $potreiro['Potreiro']['area_lavoura']; ?>
<br>
</p>
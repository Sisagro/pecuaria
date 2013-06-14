<?php
echo $this->Html->link($this->Html->image("botoes/retornar.png", array("alt" => "Retornar", "title" => "Retornar")), array('action' => 'index'), array('escape' => false));
?>
<br>
<br>
<p>
Holding: 
<?php echo $holding['Holding']['nome']; ?>
<br>
Responsável: 
<?php echo $holding['Holding']['responsavel']; ?>
<br>
Contato: 
<?php echo $holding['Holding']['contato']; ?>
<br>
Acesso ao sistema até: 
<?php echo date('d/m/Y', strtotime($holding['Holding']['validade'])); ?>
</p>


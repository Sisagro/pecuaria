<p>Home > <?php echo $title_for_layout; ?> > Editar holding</p>
<br>
<?php
echo $this->Html->link($this->Html->image("botoes/retornar.png", array("alt" => "Adicionar", "title" => "Adicionar")), array('action' => 'index'), array('escape' => false));
//echo $this->Html->link($this->Html->image("botoes/imprimir.png", array("alt" => "Imprimir", "title" => "Imprimir")), array('action' => 'print'), array('escape' => false));
?>
<br>
<br>

<?php echo $this->Form->create('Holding'); ?>
	<fieldset>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('nome');
		echo $this->Form->input('responsavel');
		echo $this->Form->input('contato');
		echo $this->Form->input('validade');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Editar')); ?>
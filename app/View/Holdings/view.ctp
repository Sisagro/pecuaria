<p>Home > <?php echo $title_for_layout; ?> > Visualizar holding</p>
<br>
<?php
echo $this->Html->link($this->Html->image("botoes/retornar.png", array("alt" => "Adicionar", "title" => "Adicionar")), array('action' => 'index'), array('escape' => false));
//echo $this->Html->link($this->Html->image("botoes/imprimir.png", array("alt" => "Imprimir", "title" => "Imprimir")), array('action' => 'print'), array('escape' => false));
?>
<br>
<br>

	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($holding['Holding']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nome'); ?></dt>
		<dd>
			<?php echo h($holding['Holding']['nome']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Responsavel'); ?></dt>
		<dd>
			<?php echo h($holding['Holding']['responsavel']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Contato'); ?></dt>
		<dd>
			<?php echo h($holding['Holding']['contato']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Validade'); ?></dt>
		<dd>
			<?php echo h($holding['Holding']['validade']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($holding['Holding']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($holding['Holding']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>


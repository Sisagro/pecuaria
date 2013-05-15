<div class="holdingempresas form">
<?php echo $this->Form->create('Holdingempresa'); ?>
	<fieldset>
		<legend><?php echo __('Edit Holdingempresa'); ?></legend>
	<?php
		echo $this->Form->input('holding_id');
		echo $this->Form->input('empresa_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Holdingempresa.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Holdingempresa.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Holdingempresas'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Holdings'), array('controller' => 'holdings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Holding'), array('controller' => 'holdings', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Empresas'), array('controller' => 'empresas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Empresa'), array('controller' => 'empresas', 'action' => 'add')); ?> </li>
	</ul>
</div>

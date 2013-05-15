<div class="holdings form">
<?php echo $this->Form->create('Holding'); ?>
	<fieldset>
		<legend><?php echo __('Edit Holding'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('nome');
		echo $this->Form->input('responsavel');
		echo $this->Form->input('contato');
		echo $this->Form->input('validade');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Holding.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Holding.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Holdings'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Holdingempresas'), array('controller' => 'holdingempresas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Holdingempresa'), array('controller' => 'holdingempresas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>

<div class="empresas form">
<?php echo $this->Form->create('Empresa'); ?>
	<fieldset>
		<legend><?php echo __('Edit Empresa'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('cdempmatriz');
		echo $this->Form->input('razaosocial');
		echo $this->Form->input('nomefantasia');
		echo $this->Form->input('cnpj');
		echo $this->Form->input('inscestadual');
		echo $this->Form->input('inscmunicipal');
		echo $this->Form->input('email');
		echo $this->Form->input('homepage');
		echo $this->Form->input('img_foto');
		echo $this->Form->input('holding_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Empresa.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Empresa.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Empresas'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Holdings'), array('controller' => 'holdings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Holding'), array('controller' => 'holdings', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Contatos'), array('controller' => 'contatos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Contato'), array('controller' => 'contatos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Enderecos'), array('controller' => 'enderecos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Endereco'), array('controller' => 'enderecos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Usergroupempresas'), array('controller' => 'usergroupempresas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Usergroupempresa'), array('controller' => 'usergroupempresas', 'action' => 'add')); ?> </li>
	</ul>
</div>

<div class="empresas form">
<?php echo $this->Form->create('Empresa'); ?>
	<fieldset>
		<legend><?php echo __('Add Empresa'); ?></legend>
	<?php
		echo $this->Form->input('cdemp');
		echo $this->Form->input('cdempmatriz');
		echo $this->Form->input('razaosocial');
		echo $this->Form->input('nomefantasia');
		echo $this->Form->input('cnpj');
		echo $this->Form->input('inscestadual');
		echo $this->Form->input('inscmunicipal');
		echo $this->Form->input('email');
		echo $this->Form->input('homepage');
		echo $this->Form->input('img_foto');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Empresas'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Holdingempresas'), array('controller' => 'holdingempresas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Holdingempresa'), array('controller' => 'holdingempresas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Userempresas'), array('controller' => 'userempresas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Userempresa'), array('controller' => 'userempresas', 'action' => 'add')); ?> </li>
	</ul>
</div>

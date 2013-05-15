<div class="holdingempresas view">
<h2><?php  echo __('Holdingempresa'); ?></h2>
	<dl>
		<dt><?php echo __('Holding'); ?></dt>
		<dd>
			<?php echo $this->Html->link($holdingempresa['Holding']['id'], array('controller' => 'holdings', 'action' => 'view', $holdingempresa['Holding']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Empresa'); ?></dt>
		<dd>
			<?php echo $this->Html->link($holdingempresa['Empresa']['id'], array('controller' => 'empresas', 'action' => 'view', $holdingempresa['Empresa']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Holdingempresa'), array('action' => 'edit', $holdingempresa['Holdingempresa']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Holdingempresa'), array('action' => 'delete', $holdingempresa['Holdingempresa']['id']), null, __('Are you sure you want to delete # %s?', $holdingempresa['Holdingempresa']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Holdingempresas'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Holdingempresa'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Holdings'), array('controller' => 'holdings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Holding'), array('controller' => 'holdings', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Empresas'), array('controller' => 'empresas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Empresa'), array('controller' => 'empresas', 'action' => 'add')); ?> </li>
	</ul>
</div>

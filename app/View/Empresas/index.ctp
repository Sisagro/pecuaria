<div class="empresas index">
	<h2><?php echo __('Empresas'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('cdemp'); ?></th>
			<th><?php echo $this->Paginator->sort('cdempmatriz'); ?></th>
			<th><?php echo $this->Paginator->sort('razaosocial'); ?></th>
			<th><?php echo $this->Paginator->sort('nomefantasia'); ?></th>
			<th><?php echo $this->Paginator->sort('cnpj'); ?></th>
			<th><?php echo $this->Paginator->sort('inscestadual'); ?></th>
			<th><?php echo $this->Paginator->sort('inscmunicipal'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('homepage'); ?></th>
			<th><?php echo $this->Paginator->sort('img_foto'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($empresas as $empresa): ?>
	<tr>
		<td><?php echo h($empresa['Empresa']['id']); ?>&nbsp;</td>
		<td><?php echo h($empresa['Empresa']['cdemp']); ?>&nbsp;</td>
		<td><?php echo h($empresa['Empresa']['cdempmatriz']); ?>&nbsp;</td>
		<td><?php echo h($empresa['Empresa']['razaosocial']); ?>&nbsp;</td>
		<td><?php echo h($empresa['Empresa']['nomefantasia']); ?>&nbsp;</td>
		<td><?php echo h($empresa['Empresa']['cnpj']); ?>&nbsp;</td>
		<td><?php echo h($empresa['Empresa']['inscestadual']); ?>&nbsp;</td>
		<td><?php echo h($empresa['Empresa']['inscmunicipal']); ?>&nbsp;</td>
		<td><?php echo h($empresa['Empresa']['email']); ?>&nbsp;</td>
		<td><?php echo h($empresa['Empresa']['homepage']); ?>&nbsp;</td>
		<td><?php echo h($empresa['Empresa']['img_foto']); ?>&nbsp;</td>
		<td><?php echo h($empresa['Empresa']['created']); ?>&nbsp;</td>
		<td><?php echo h($empresa['Empresa']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $empresa['Empresa']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $empresa['Empresa']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $empresa['Empresa']['id']), null, __('Are you sure you want to delete # %s?', $empresa['Empresa']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Empresa'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Holdingempresas'), array('controller' => 'holdingempresas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Holdingempresa'), array('controller' => 'holdingempresas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Userempresas'), array('controller' => 'userempresas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Userempresa'), array('controller' => 'userempresas', 'action' => 'add')); ?> </li>
	</ul>
</div>

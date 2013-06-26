<div class="usergroupempresas index">
	<h2><?php echo __('Usergroupempresas'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('empresa_id'); ?></th>
			<th><?php echo $this->Paginator->sort('group_id'); ?></th>
			<th><?php echo $this->Paginator->sort('empresaboot'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($usergroupempresas as $usergroupempresa): ?>
	<tr>
		<td><?php echo h($usergroupempresa['Usergroupempresa']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($usergroupempresa['User']['id'], array('controller' => 'users', 'action' => 'view', $usergroupempresa['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($usergroupempresa['Empresa']['id'], array('controller' => 'empresas', 'action' => 'view', $usergroupempresa['Empresa']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($usergroupempresa['Group']['name'], array('controller' => 'groups', 'action' => 'view', $usergroupempresa['Group']['id'])); ?>
		</td>
		<td><?php echo h($usergroupempresa['Usergroupempresa']['empresaboot']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $usergroupempresa['Usergroupempresa']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $usergroupempresa['Usergroupempresa']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $usergroupempresa['Usergroupempresa']['id']), null, __('Are you sure you want to delete # %s?', $usergroupempresa['Usergroupempresa']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Usergroupempresa'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Empresas'), array('controller' => 'empresas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Empresa'), array('controller' => 'empresas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Groups'), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group'), array('controller' => 'groups', 'action' => 'add')); ?> </li>
	</ul>
</div>

<div class="userempresas index">
	<h2><?php echo __('Userempresas'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('empresa_id'); ?></th>
			<th><?php echo $this->Paginator->sort('group_id'); ?></th>
			<th><?php echo $this->Paginator->sort('empresaboot'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($userempresas as $userempresa): ?>
	<tr>
		<td><?php echo h($userempresa['Userempresa']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($userempresa['User']['id'], array('controller' => 'users', 'action' => 'view', $userempresa['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($userempresa['Empresa']['id'], array('controller' => 'empresas', 'action' => 'view', $userempresa['Empresa']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($userempresa['Group']['name'], array('controller' => 'groups', 'action' => 'view', $userempresa['Group']['id'])); ?>
		</td>
		<td><?php echo h($userempresa['Userempresa']['empresaboot']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $userempresa['Userempresa']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $userempresa['Userempresa']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $userempresa['Userempresa']['id']), null, __('Are you sure you want to delete # %s?', $userempresa['Userempresa']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Userempresa'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Empresas'), array('controller' => 'empresas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Empresa'), array('controller' => 'empresas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Groups'), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group'), array('controller' => 'groups', 'action' => 'add')); ?> </li>
	</ul>
</div>

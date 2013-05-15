<div class="groups view">
<h2><?php  echo __('Group'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($group['Group']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($group['Group']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($group['Group']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($group['Group']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Group'), array('action' => 'edit', $group['Group']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Group'), array('action' => 'delete', $group['Group']['id']), null, __('Are you sure you want to delete # %s?', $group['Group']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Groups'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Userempresas'), array('controller' => 'userempresas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Userempresa'), array('controller' => 'userempresas', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Userempresas'); ?></h3>
	<?php if (!empty($group['Userempresa'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Empresa Id'); ?></th>
		<th><?php echo __('Group Id'); ?></th>
		<th><?php echo __('Empresaboot'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($group['Userempresa'] as $userempresa): ?>
		<tr>
			<td><?php echo $userempresa['id']; ?></td>
			<td><?php echo $userempresa['user_id']; ?></td>
			<td><?php echo $userempresa['empresa_id']; ?></td>
			<td><?php echo $userempresa['group_id']; ?></td>
			<td><?php echo $userempresa['empresaboot']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'userempresas', 'action' => 'view', $userempresa['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'userempresas', 'action' => 'edit', $userempresa['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'userempresas', 'action' => 'delete', $userempresa['id']), null, __('Are you sure you want to delete # %s?', $userempresa['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Userempresa'), array('controller' => 'userempresas', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>

<div class="users view">
<h2><?php  echo __('User'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($user['User']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($user['User']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nome'); ?></dt>
		<dd>
			<?php echo h($user['User']['nome']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sobrenome'); ?></dt>
		<dd>
			<?php echo h($user['User']['sobrenome']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Img Foto'); ?></dt>
		<dd>
			<?php echo h($user['User']['img_foto']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Holding'); ?></dt>
		<dd>
			<?php echo $this->Html->link($user['Holding']['id'], array('controller' => 'holdings', 'action' => 'view', $user['Holding']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ultimoacesso'); ?></dt>
		<dd>
			<?php echo h($user['User']['ultimoacesso']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($user['User']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($user['User']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Holdings'), array('controller' => 'holdings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Holding'), array('controller' => 'holdings', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Userempresas'), array('controller' => 'userempresas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Userempresa'), array('controller' => 'userempresas', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Userempresas'); ?></h3>
	<?php if (!empty($user['Userempresa'])): ?>
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
		foreach ($user['Userempresa'] as $userempresa): ?>
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

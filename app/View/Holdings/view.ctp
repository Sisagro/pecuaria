<div class="holdings view">
<h2><?php  echo __('Holding'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($holding['Holding']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nome'); ?></dt>
		<dd>
			<?php echo h($holding['Holding']['nome']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Responsavel'); ?></dt>
		<dd>
			<?php echo h($holding['Holding']['responsavel']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Contato'); ?></dt>
		<dd>
			<?php echo h($holding['Holding']['contato']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Validade'); ?></dt>
		<dd>
			<?php echo h($holding['Holding']['validade']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($holding['Holding']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($holding['Holding']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Holding'), array('action' => 'edit', $holding['Holding']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Holding'), array('action' => 'delete', $holding['Holding']['id']), null, __('Are you sure you want to delete # %s?', $holding['Holding']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Holdings'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Holding'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Holdingempresas'), array('controller' => 'holdingempresas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Holdingempresa'), array('controller' => 'holdingempresas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Holdingempresas'); ?></h3>
	<?php if (!empty($holding['Holdingempresa'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Holding Id'); ?></th>
		<th><?php echo __('Empresa Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($holding['Holdingempresa'] as $holdingempresa): ?>
		<tr>
			<td><?php echo $holdingempresa['holding_id']; ?></td>
			<td><?php echo $holdingempresa['empresa_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'holdingempresas', 'action' => 'view', $holdingempresa['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'holdingempresas', 'action' => 'edit', $holdingempresa['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'holdingempresas', 'action' => 'delete', $holdingempresa['id']), null, __('Are you sure you want to delete # %s?', $holdingempresa['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Holdingempresa'), array('controller' => 'holdingempresas', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Users'); ?></h3>
	<?php if (!empty($holding['User'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Username'); ?></th>
		<th><?php echo __('Password'); ?></th>
		<th><?php echo __('Nome'); ?></th>
		<th><?php echo __('Sobrenome'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Img Foto'); ?></th>
		<th><?php echo __('Holding Id'); ?></th>
		<th><?php echo __('Ultimoacesso'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($holding['User'] as $user): ?>
		<tr>
			<td><?php echo $user['id']; ?></td>
			<td><?php echo $user['username']; ?></td>
			<td><?php echo $user['password']; ?></td>
			<td><?php echo $user['nome']; ?></td>
			<td><?php echo $user['sobrenome']; ?></td>
			<td><?php echo $user['email']; ?></td>
			<td><?php echo $user['img_foto']; ?></td>
			<td><?php echo $user['holding_id']; ?></td>
			<td><?php echo $user['ultimoacesso']; ?></td>
			<td><?php echo $user['created']; ?></td>
			<td><?php echo $user['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'users', 'action' => 'edit', $user['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'users', 'action' => 'delete', $user['id']), null, __('Are you sure you want to delete # %s?', $user['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>

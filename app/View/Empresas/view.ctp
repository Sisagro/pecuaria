<div class="empresas view">
<h2><?php  echo __('Empresa'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($empresa['Empresa']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cdemp'); ?></dt>
		<dd>
			<?php echo h($empresa['Empresa']['cdemp']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cdempmatriz'); ?></dt>
		<dd>
			<?php echo h($empresa['Empresa']['cdempmatriz']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Razaosocial'); ?></dt>
		<dd>
			<?php echo h($empresa['Empresa']['razaosocial']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nomefantasia'); ?></dt>
		<dd>
			<?php echo h($empresa['Empresa']['nomefantasia']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cnpj'); ?></dt>
		<dd>
			<?php echo h($empresa['Empresa']['cnpj']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Inscestadual'); ?></dt>
		<dd>
			<?php echo h($empresa['Empresa']['inscestadual']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Inscmunicipal'); ?></dt>
		<dd>
			<?php echo h($empresa['Empresa']['inscmunicipal']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($empresa['Empresa']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Homepage'); ?></dt>
		<dd>
			<?php echo h($empresa['Empresa']['homepage']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Img Foto'); ?></dt>
		<dd>
			<?php echo h($empresa['Empresa']['img_foto']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($empresa['Empresa']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($empresa['Empresa']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Empresa'), array('action' => 'edit', $empresa['Empresa']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Empresa'), array('action' => 'delete', $empresa['Empresa']['id']), null, __('Are you sure you want to delete # %s?', $empresa['Empresa']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Empresas'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Empresa'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Holdingempresas'), array('controller' => 'holdingempresas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Holdingempresa'), array('controller' => 'holdingempresas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Userempresas'), array('controller' => 'userempresas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Userempresa'), array('controller' => 'userempresas', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Holdingempresas'); ?></h3>
	<?php if (!empty($empresa['Holdingempresa'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Holding Id'); ?></th>
		<th><?php echo __('Empresa Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($empresa['Holdingempresa'] as $holdingempresa): ?>
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
	<h3><?php echo __('Related Userempresas'); ?></h3>
	<?php if (!empty($empresa['Userempresa'])): ?>
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
		foreach ($empresa['Userempresa'] as $userempresa): ?>
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

<div class="empresas view">
<h2><?php  echo __('Empresa'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($empresa['Empresa']['id']); ?>
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
		<dt><?php echo __('Holding'); ?></dt>
		<dd>
			<?php echo $this->Html->link($empresa['Holding']['id'], array('controller' => 'holdings', 'action' => 'view', $empresa['Holding']['id'])); ?>
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
<div class="related">
	<h3><?php echo __('Related Contatos'); ?></h3>
	<?php if (!empty($empresa['Contato'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Empresa Id'); ?></th>
		<th><?php echo __('Nome'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Fone'); ?></th>
		<th><?php echo __('Observacao'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($empresa['Contato'] as $contato): ?>
		<tr>
			<td><?php echo $contato['id']; ?></td>
			<td><?php echo $contato['empresa_id']; ?></td>
			<td><?php echo $contato['nome']; ?></td>
			<td><?php echo $contato['email']; ?></td>
			<td><?php echo $contato['fone']; ?></td>
			<td><?php echo $contato['observacao']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'contatos', 'action' => 'view', $contato['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'contatos', 'action' => 'edit', $contato['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'contatos', 'action' => 'delete', $contato['id']), null, __('Are you sure you want to delete # %s?', $contato['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Contato'), array('controller' => 'contatos', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Enderecos'); ?></h3>
	<?php if (!empty($empresa['Endereco'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Empresa Id'); ?></th>
		<th><?php echo __('Cidade Id'); ?></th>
		<th><?php echo __('Rua'); ?></th>
		<th><?php echo __('Bairro'); ?></th>
		<th><?php echo __('Numero'); ?></th>
		<th><?php echo __('Complemento'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($empresa['Endereco'] as $endereco): ?>
		<tr>
			<td><?php echo $endereco['id']; ?></td>
			<td><?php echo $endereco['empresa_id']; ?></td>
			<td><?php echo $endereco['cidade_id']; ?></td>
			<td><?php echo $endereco['rua']; ?></td>
			<td><?php echo $endereco['bairro']; ?></td>
			<td><?php echo $endereco['numero']; ?></td>
			<td><?php echo $endereco['complemento']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'enderecos', 'action' => 'view', $endereco['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'enderecos', 'action' => 'edit', $endereco['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'enderecos', 'action' => 'delete', $endereco['id']), null, __('Are you sure you want to delete # %s?', $endereco['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Endereco'), array('controller' => 'enderecos', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Usergroupempresas'); ?></h3>
	<?php if (!empty($empresa['Usergroupempresa'])): ?>
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
		foreach ($empresa['Usergroupempresa'] as $usergroupempresa): ?>
		<tr>
			<td><?php echo $usergroupempresa['id']; ?></td>
			<td><?php echo $usergroupempresa['user_id']; ?></td>
			<td><?php echo $usergroupempresa['empresa_id']; ?></td>
			<td><?php echo $usergroupempresa['group_id']; ?></td>
			<td><?php echo $usergroupempresa['empresaboot']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'usergroupempresas', 'action' => 'view', $usergroupempresa['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'usergroupempresas', 'action' => 'edit', $usergroupempresa['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'usergroupempresas', 'action' => 'delete', $usergroupempresa['id']), null, __('Are you sure you want to delete # %s?', $usergroupempresa['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Usergroupempresa'), array('controller' => 'usergroupempresas', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>

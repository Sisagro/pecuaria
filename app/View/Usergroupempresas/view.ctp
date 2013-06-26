<div class="usergroupempresas view">
<h2><?php  echo __('Usergroupempresa'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($usergroupempresa['Usergroupempresa']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($usergroupempresa['User']['id'], array('controller' => 'users', 'action' => 'view', $usergroupempresa['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Empresa'); ?></dt>
		<dd>
			<?php echo $this->Html->link($usergroupempresa['Empresa']['id'], array('controller' => 'empresas', 'action' => 'view', $usergroupempresa['Empresa']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Group'); ?></dt>
		<dd>
			<?php echo $this->Html->link($usergroupempresa['Group']['name'], array('controller' => 'groups', 'action' => 'view', $usergroupempresa['Group']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Empresaboot'); ?></dt>
		<dd>
			<?php echo h($usergroupempresa['Usergroupempresa']['empresaboot']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Usergroupempresa'), array('action' => 'edit', $usergroupempresa['Usergroupempresa']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Usergroupempresa'), array('action' => 'delete', $usergroupempresa['Usergroupempresa']['id']), null, __('Are you sure you want to delete # %s?', $usergroupempresa['Usergroupempresa']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Usergroupempresas'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Usergroupempresa'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Empresas'), array('controller' => 'empresas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Empresa'), array('controller' => 'empresas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Groups'), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group'), array('controller' => 'groups', 'action' => 'add')); ?> </li>
	</ul>
</div>

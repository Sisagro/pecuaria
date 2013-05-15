<div class="userempresas view">
<h2><?php  echo __('Userempresa'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($userempresa['Userempresa']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userempresa['User']['id'], array('controller' => 'users', 'action' => 'view', $userempresa['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Empresa'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userempresa['Empresa']['id'], array('controller' => 'empresas', 'action' => 'view', $userempresa['Empresa']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Group'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userempresa['Group']['name'], array('controller' => 'groups', 'action' => 'view', $userempresa['Group']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Empresaboot'); ?></dt>
		<dd>
			<?php echo h($userempresa['Userempresa']['empresaboot']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Userempresa'), array('action' => 'edit', $userempresa['Userempresa']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Userempresa'), array('action' => 'delete', $userempresa['Userempresa']['id']), null, __('Are you sure you want to delete # %s?', $userempresa['Userempresa']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Userempresas'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Userempresa'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Empresas'), array('controller' => 'empresas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Empresa'), array('controller' => 'empresas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Groups'), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group'), array('controller' => 'groups', 'action' => 'add')); ?> </li>
	</ul>
</div>

<p>Home > <?php echo $title_for_layout; ?></p>
<br>
<?php
echo $this->Html->link($this->Html->image("botoes/add.png", array("alt" => "Adicionar", "title" => "Adicionar")), array('action' => 'add'), array('escape' => false) );
echo $this->Html->link($this->Html->image("botoes/imprimir.png", array("alt" => "Imprimir", "title" => "Imprimir")), array('action' => 'print'), array('escape' => false) );
?>
<br>
<br>
<table cellpadding="0" cellspacing="0">
<tr>
                <th><?php echo $this->Paginator->sort('id'); ?></th>
                <th><?php echo $this->Paginator->sort('nome'); ?></th>
                <th><?php echo $this->Paginator->sort('responsavel'); ?></th>
                <th><?php echo $this->Paginator->sort('contato'); ?></th>
                <th><?php echo $this->Paginator->sort('validade'); ?></th>
                <th><?php echo $this->Paginator->sort('created'); ?></th>
                <th><?php echo $this->Paginator->sort('modified'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
</tr>
<?php
foreach ($holdings as $holding): ?>
<tr>
        <td><?php echo h($holding['Holding']['id']); ?>&nbsp;</td>
        <td><?php echo h($holding['Holding']['nome']); ?>&nbsp;</td>
        <td><?php echo h($holding['Holding']['responsavel']); ?>&nbsp;</td>
        <td><?php echo h($holding['Holding']['contato']); ?>&nbsp;</td>
        <td><?php echo h($holding['Holding']['validade']); ?>&nbsp;</td>
        <td><?php echo h($holding['Holding']['created']); ?>&nbsp;</td>
        <td><?php echo h($holding['Holding']['modified']); ?>&nbsp;</td>
        <td class="actions">
                <?php echo $this->Html->link(__('View'), array('action' => 'view', $holding['Holding']['id'])); ?>
                <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $holding['Holding']['id'])); ?>
                <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $holding['Holding']['id']), null, __('Are you sure you want to delete # %s?', $holding['Holding']['id'])); ?>
        </td>
</tr>
<?php 
endforeach; 
?>
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


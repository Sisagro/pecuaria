<?php
echo $this->Html->link($this->Html->image("botoes/add.png", array("alt" => "Adicionar", "title" => "Adicionar")), array('action' => 'add'), array('escape' => false));
echo $this->Html->link($this->Html->image("botoes/imprimir.png", array("alt" => "Imprimir", "title" => "Imprimir")), array('action' => 'print'), array('escape' => false));
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
        <th class="actions"><?php echo __('Actions'); ?></th>
    </tr>
    <?php foreach ($holdings as $holding): ?>
        <tr>
            <td><?php echo h($holding['Holding']['id']); ?>&nbsp;</td>
            <td><?php echo h($holding['Holding']['nome']); ?>&nbsp;</td>
            <td><?php echo h($holding['Holding']['responsavel']); ?>&nbsp;</td>
            <td><?php echo h($holding['Holding']['contato']); ?>&nbsp;</td>
            <td><?php echo date('d/m/Y', strtotime($holding['Holding']['validade'])); ?></td>
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
<br>
<p>
    <?php
    if ($this->Paginator->counter('{:pages}') > 1) {
        echo "<p> &nbsp; | " . $this->Paginator->numbers() . "| </p>";
    } else {
        echo $this->Paginator->counter('{:count}') . " registros encontrados.";
    }
    ?>
</p>


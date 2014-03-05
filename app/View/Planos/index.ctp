<?php
echo $this->Html->link($this->Html->image("botoes/add.png", array("alt" => "Adicionar", "title" => "Adicionar")), array('action' => 'add'), array('escape' => false));
//echo $this->Html->link($this->Html->image("botoes/imprimir.png", array("alt" => "Imprimir", "title" => "Imprimir")), array('action' => 'print'), array('escape' => false));
?>
<br>
<br>
<table cellpadding="0" cellspacing="0">
    <tr>
        <th><?php echo $this->Paginator->sort('id'); ?></th>
        <th><?php echo $this->Paginator->sort('descricao'); ?></th>
        <th><?php echo $this->Paginator->sort('usuario'); ?></th>
        <th><?php echo $this->Paginator->sort('empresa'); ?></th>
        <th><?php echo $this->Paginator->sort('animal'); ?></th>
        <th><?php echo $this->Paginator->sort('valor'); ?></th>
        <th class="actions"><?php echo __('Ações'); ?></th>
    </tr>
    <?php foreach ($planos as $plano): ?>
        <tr>
            <td><?php echo h($plano['Plano']['id']); ?>&nbsp;</td>
            <td><?php echo h($plano['Plano']['descricao']); ?>&nbsp;</td>
            <td><?php echo h($plano['Plano']['usuario']); ?>&nbsp;</td>
            <td><?php echo h($plano['Plano']['empresa']); ?>&nbsp;</td>
            <td><?php echo h($plano['Plano']['animal']); ?>&nbsp;</td>
            <td><?php echo h($plano['Plano']['valor']); ?>&nbsp;</td>
            <td>
                <div id="botoes">
                    <?php
                    echo $this->Html->link($this->Html->image("botoes/view.png", array("alt" => "Visualizar", "title" => "Visualizar")), array('action' => 'view', $plano['Plano']['id']), array('escape' => false));
                    echo $this->Html->link($this->Html->image("botoes/editar.gif", array("alt" => "Editar", "title" => "Editar")), array('action' => 'edit', $plano['Plano']['id']), array('escape' => false));
                    echo $this->Form->postLink($this->Html->image('botoes/excluir.gif', array('alt' => 'Exluir', 'title' => 'Exluir')),
                                               array('action' => 'delete', $plano['Plano']['id']), array('escape' => false),
                                               __('Você realmete deseja apagar esse item?')
                                              );
                    
                    ?>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
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
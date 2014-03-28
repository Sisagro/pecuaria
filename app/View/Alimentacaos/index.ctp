<?php
echo $this->Html->link($this->Html->image("botoes/add.png", array("alt" => "Adicionar", "title" => "Adicionar")), array('action' => 'add'), array('escape' => false));
//echo $this->Html->link($this->Html->image("botoes/imprimir.png", array("alt" => "Imprimir", "title" => "Imprimir")), array('action' => 'print'), array('escape' => false));
?>
<br>
<br>

<table cellpadding="0" cellspacing="0">
    <tr>
        <th><?php echo $this->Paginator->sort('id'); ?></th>
        <th><?php echo $this->Paginator->sort('Melhoracampo.descricao', 'Melhoria de campo'); ?></th>      
        <th><?php echo 'Lote'; ?></th>
        <th><?php echo 'Categoria'; ?></th>
        <th><?php echo $this->Paginator->sort('dtalimentacao', 'Data da alimentação'); ?></th>
        <th class="actions"><?php echo __('Ações'); ?></th>
    </tr>
    <?php foreach ($itens as $item): ?>
        <tr>
            <td><?php echo h($item['Alimentacao']['id']); ?>&nbsp;</td>
            <td><?php echo h($item['Eventomelhoracampo']['Melhoracampo']['descricao']); ?>&nbsp;</td>
            <td><?php echo h($item['Categorialote']['Lote']['descricao']); ?>&nbsp;</td>
            <td><?php echo h($item['Categorialote']['Categoria']['descricao']); ?>&nbsp;</td>            
            <td><?php echo h($item['Alimentacao']['dtalimentacao']); ?>&nbsp;</td>
            <td>
                <div id="botoes">
                    <?php
                    echo $this->Html->link($this->Html->image("botoes/view.png", array("alt" => "Visualizar", "title" => "Visualizar")), array('action' => 'view', $item['Alimentacao']['id']), array('escape' => false));
                    echo $this->Html->link($this->Html->image("botoes/editar.gif", array("alt" => "Editar", "title" => "Editar")), array('action' => 'edit', $item['Alimentacao']['id']), array('escape' => false));
                    echo $this->Form->postLink($this->Html->image('botoes/excluir.gif', array('alt' => 'Exluir', 'title' => 'Exluir')),
                                               array('action' => 'delete', $item['Alimentacao']['id']), array('escape' => false),
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
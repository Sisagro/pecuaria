<?php
echo $this->Html->link($this->Html->image("botoes/add.png", array("alt" => "Adicionar", "title" => "Adicionar")), array('action' => 'add'), array('escape' => false));
//echo $this->Html->link($this->Html->image("botoes/imprimir.png", array("alt" => "Imprimir", "title" => "Imprimir")), array('action' => 'print'), array('escape' => false));
//debug($animais);
?>
<br>
<br>
<table cellpadding="0" cellspacing="0">
    <tr>
        <th><?php echo $this->Paginator->sort('id'); ?></th>
        <th><?php echo $this->Paginator->sort('Especy.descricao', 'Espécie'); ?></th>
        <th><?php echo $this->Paginator->sort('Categoria.descricao', 'Categoria'); ?></th>
        <th><?php echo $this->Paginator->sort('brinco', 'Brinco'); ?></th>
        <th><?php echo $this->Paginator->sort('tatuagem', 'Tatuagem'); ?></th>
        <th><?php echo $this->Paginator->sort('hbbsbb', 'HBB/SBB'); ?></th>
        <th><?php echo $this->Paginator->sort('ativo', 'Ativo'); ?></th>
        <th class="actions"><?php echo __('Ações'); ?></th>
    </tr>
    <?php foreach ($animais as $item): ?>
        <tr>
            <td><?php echo h($item['Animai']['id']); ?>&nbsp;</td>
            <td><?php echo h($item['Especy']['descricao']); ?>&nbsp;</td>
            <td><?php echo h($item['Categoria']['descricao']); ?>&nbsp;</td>
            
            <td><?php echo h($item['Animai']['brinco']); ?>&nbsp;</td>
            <td><?php echo h($item['Animai']['tatuagem']); ?>&nbsp;</td>
            <td><?php echo h($item['Animai']['hbbsbb']); ?>&nbsp;</td>
            <td><?php if ($item['Animai']['ativo'] == 'A') { echo h('SIM'); } else { echo h('NÃO'); } ?>&nbsp;</td>
            <td>
                <div id="botoes">
                    <?php
                    echo $this->Html->link($this->Html->image("botoes/view.png", array("alt" => "Visualizar", "title" => "Visualizar")), array('action' => 'view', $item['Animai']['id']), array('escape' => false));
                    echo $this->Html->link($this->Html->image("botoes/editar.gif", array("alt" => "Editar", "title" => "Editar")), array('action' => 'edit', $item['Animai']['id']), array('escape' => false));
                    echo $this->Form->postLink($this->Html->image('botoes/excluir.gif', array('alt' => 'Exluir', 'title' => 'Exluir')),
                                               array('action' => 'delete', $item['Animai']['id']), array('escape' => false),
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
<?php
echo $this->Html->link($this->Html->image("botoes/add.png", array("alt" => "Adicionar", "title" => "Adicionar")), array('action' => 'add'), array('escape' => false));
//echo $this->Html->link($this->Html->image("botoes/imprimir.png", array("alt" => "Imprimir", "title" => "Imprimir")), array('action' => 'print'), array('escape' => false));
?>
<br>
<br>

<div id="filtroGrade">
    <?php
    echo $this->Search->create();
    echo $this->Search->input('filter1', array('class' => 'select-box', 'empty' => '-- Espécie --'));
    echo $this->Html->image("separador.png");
    echo $this->Search->input('filter2', array('class' => 'select-box', 'empty' => '-- Sexo --'));
    echo $this->Html->image("separador.png");
    echo $this->Search->input('filter3', array('class' => 'select-box', 'empty' => '-- Categoria --'));
    echo $this->Html->image("separador.png");
    echo $this->Search->input('filter4', array('class' => 'select-box', 'empty' => '-- Lote --'));
    echo $this->Html->image("separador.png");
    ?>
    <input  type="submit" value="Filtrar" class="botaoFiltro"/>

</div>

<form action="/FNRCake/Jogos/delete/1230920390239" name="post_69348294s3efsfd989" id="post_69348294s3efsfd989" style="display:none;" method="post">
    <input type="hidden" name="_method" value="POST"/>
</form>
<a href="#" onclick="if (confirm('Você realmete deseja apagar esse item?')) { document.post_69348294s3efsfd989.submit(); } event.returnValue = false; return false;">
</a>

<table cellpadding="0" cellspacing="0">
    <tr>
        <th><?php echo $this->Paginator->sort('id'); ?></th>
        <th><?php echo $this->Paginator->sort('Lote.descricao', 'Lote'); ?></th>
        <th><?php echo $this->Paginator->sort('Categoria.descricao', 'Categoria'); ?></th>
        <th><?php echo $this->Paginator->sort('Potreiro.descricao', 'Potreiro'); ?></th>
        <th class="actions"><?php echo __('Ações'); ?></th>
    </tr>
    <?php foreach ($categorialotes as $item): ?>
        <tr>
            <td><?php echo h($item['Categorialote']['id']); ?>&nbsp;</td>
            <td><?php echo h($item['Lote']['descricao']); ?>&nbsp;</td>
            <td><?php echo h($item['Categoria']['descricao']); ?>&nbsp;</td>
            <td><?php echo h($item['Potreiro']['descricao']); ?>&nbsp;</td>
            <td>
                <div id="botoes">
                    <?php
                    echo $this->Html->link($this->Html->image("botoes/view.png", array("alt" => "Visualizar", "title" => "Visualizar")), array('action' => 'view', $item['Categorialote']['id']), array('escape' => false));
                    echo $this->Form->postLink($this->Html->image('botoes/excluir.gif', array('alt' => 'Exluir', 'title' => 'Exluir')),
                                               array('action' => 'delete', $item['Categorialote']['id']), array('escape' => false),
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

<script type="text/javascript">
    jQuery(document).ready(function(){
        document.getElementById('filterFilter1').focus();
        
        $("#filterFilter1").change( function(){
            var select = jQuery('#filterFilter2');
            select.val(jQuery('option:first', select).val());
            var select = jQuery('#filterFilter3');
            select.val(jQuery('option:first', select).val());
        });
        
        $("#filterFilter2").change( function(){
            $.ajax({async:true, 
                    data:$("#filterFilter2").serialize(), 
                    dataType:"html",
                    success:function (data, textStatus) {
                        $("#filterFilter3").html(data);
                    },
                    type:"post",
                    url:"\/pecuaria/Categorias\/buscaCategoriasAnimais\/filter\/filter2\/"  + $("#filterFilter1 option:selected").val()
            });
        });
        
    });
</script>
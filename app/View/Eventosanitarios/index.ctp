<?php
echo $this->Html->link($this->Html->image("botoes/add.png", array("alt" => "Adicionar", "title" => "Adicionar")), array('action' => 'add'), array('escape' => false));
//echo $this->Html->link($this->Html->image("botoes/imprimir.png", array("alt" => "Imprimir", "title" => "Imprimir")), array('action' => 'print'), array('escape' => false));
echo $this->Search->create();
?>
<br>
<br>

<div id="filtroGrade">
    <select name="data[filter][especie_id]" class="select-box" id="especieID">
        <option value="">-- Espécie --</option>
        <?php
        foreach ($especies as $key => $value):
            echo "<option value='" . $key . "'>" . $value . "</option>";
        endforeach;
        ?>
    </select>
    <?php
    echo $this->Html->image("separador.png");
    ?>
    <select name="data[filter][sexo]" class="select-box" id="sexo">
        <option value="">-- Sexo --</option>
        <?php
        foreach ($sexos as $key => $value):
            echo "<option value='" . $key . "'>" . $value . "</option>";
        endforeach;
        ?>
    </select>
    <?php
    echo $this->Html->image("separador.png");
    echo $this->Search->input('filter1', array('class' => 'select-box', 'empty' => '-- Categoria --'));
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
        <th><?php echo 'Lote'; ?></th>
        <th><?php echo 'Categoria'; ?></th>
        <th><?php echo $this->Paginator->sort('dtevento', 'Data do evento'); ?></th>
        <th><?php echo $this->Paginator->sort('Medicamento.descricao', 'Medicamento'); ?></th>
        <th><?php echo $this->Paginator->sort('dosagem', 'Dosagem'); ?></th>
        <th><?php echo $this->Paginator->sort('valor', 'Valor'); ?></th>
        <th class="actions"><?php echo __('Ações'); ?></th>
    </tr>
    <?php foreach ($itens as $item): ?>
        <tr>
            <td><?php echo h($item['Eventosanitario']['id']); ?>&nbsp;</td>
            <td><?php echo h($item['Categorialote']['Lote']['descricao']); ?>&nbsp;</td>
            <td><?php echo h($item['Categorialote']['Categoria']['descricao']); ?>&nbsp;</td>
            <td><?php echo h($item['Eventosanitario']['dtevento']); ?>&nbsp;</td>
            <td><?php echo h($item['Medicamento']['descricao']); ?>&nbsp;</td>
            <td><?php echo h($item['Eventosanitario']['dosagem']); ?>&nbsp;</td>
            <td><?php echo h($item['Eventosanitario']['valor']); ?>&nbsp;</td>
            <td>
                <div id="botoes">
                    <?php
                    echo $this->Html->link($this->Html->image("botoes/view.png", array("alt" => "Visualizar", "title" => "Visualizar")), array('action' => 'view', $item['Eventosanitario']['id']), array('escape' => false));
                    echo $this->Html->link($this->Html->image("botoes/editar.gif", array("alt" => "Editar", "title" => "Editar")), array('action' => 'edit', $item['Eventosanitario']['id']), array('escape' => false));
                    echo $this->Form->postLink($this->Html->image('botoes/excluir.gif', array('alt' => 'Exluir', 'title' => 'Exluir')),
                                               array('action' => 'delete', $item['Eventosanitario']['id']), array('escape' => false),
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
        document.getElementById('especieID').focus();
        
        $("#especieID").change( function(){
            var select = jQuery('#sexo');
            select.val(jQuery('option:first', select).val());
            var select = jQuery('#filterFilter1');
            select.val(jQuery('option:first', select).val());
        });
        
        $("#sexo").change( function(){
            $.ajax({async:true, 
                    data:$("#sexo").serialize(), 
                    dataType:"html",
                    success:function (data, textStatus) {
                        $("#filterFilter1").html(data);
                    },
                    type:"post",
                    url:"\/pecuaria/Categorias\/buscaCategoriasAnimais\/filter\/sexo\/"  + $("#especieID option:selected").val()
            });
        });
        
    });
</script>
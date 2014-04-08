<?php
echo $this->Html->link($this->Html->image("botoes/retornar.png", array("alt" => "Retornar", "title" => "Retornar")), array('action' => 'index'), array('escape' => false, 'onclick' => 'history.go(-1); return false;'));
?>
<br>
<br>
<?php echo $this->Form->create('Relatorio', array('target' => '_blank')); ?>
<?php //echo $this->Form->create('Relatorio'); ?>
<fieldset>
    <?php
    echo $this->Form->input('lote_id', array ('id' => 'loteID', 'type' => 'select', 'options' => $lotes, 'label' => 'Lote', 'empty' => '-- Selecione o lote --', 'value' => ''));
    echo $this->Form->input('categoria_id', array('id' => 'categoriaID', 'type' => 'select', 'label' => 'Categoria', 'empty' => ' '));
    echo $this->Form->input('tprelatorio', array ('id' => 'tprelatorio', 'type' => 'select','options' => $tprelatorio, 'label' => 'Tipo de relatório'));
    ?>

<?php echo $this->Form->end(__('Imprimir')); ?>

<?php
$this->Js->get('#loteID')->event(
    'change',
    $this->Js->request(
        array('controller' => 'Categorias', 'action' => 'buscaCategoriasLotes', 'Relatorio'),
        array(  'update' => '#categoriaID',
                'async' => true,
		'method' => 'post',
		'dataExpression'=>true,
		'data'=> $this->Js->serializeForm(array(
                        'isForm' => true,
			'inline' => true
			)),
            )
    )
);
?>

<script type="text/javascript">
    jQuery(document).ready(function(){
        document.getElementById('loteID').focus();
        $("#categoriaID").change( function(){
            $.ajax({async:true, 
                    data:$("#categoriaID").serialize(), 
                    dataType:"html",
                    success:function (data, textStatus) {
                        $("#categorialoteID").html(data);
                    },
                    type:"post",
                    url:"\/pecuaria/categorialotes\/buscaId\/Relatorio\/" + $("#loteID option:selected").val()
            });
        });
    });
</script>
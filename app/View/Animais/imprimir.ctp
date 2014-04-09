<?php
echo $this->Html->link($this->Html->image("botoes/retornar.png", array("alt" => "Retornar", "title" => "Retornar")), array('action' => 'index'), array('escape' => false, 'onclick' => 'history.go(-1); return false;'));
?>
<br>
<br>
<?php echo $this->Form->create('Relatorio'); ?>
<fieldset>
    <?php
    echo $this->Form->input('especie_id', array ('id' => 'especieID', 'type' => 'select','options' => $especies, 'label' => 'Espécie', 'empty' => '-- Selecione a espécie --'));
    echo $this->Form->input('sexo', array ('id' => 'sexoID', 'type' => 'select', 'options' => $sexos, 'label' => 'Sexo', 'empty' => '-- Selecione o sexo --'));
    echo $this->Form->input('categoria_id', array('id' => 'categoriaID', 'type' => 'select', 'label' => 'Categoria'));
    ?>
</fieldset>

<?php echo $this->Form->end(__('Imprimir')); ?>

<?php
$this->Js->get('#especieID')->event(
    'change',
    $this->Js->request(
        array('controller' => 'Racas', 'action' => 'buscaRacas', 'Relatorio'),
        array(  'update' => '#racaID',
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
        document.getElementById('especieID').focus();
        $("#especieID").change( function(){
            $('#categoriaID option').remove();
            var select = jQuery('#sexoID');
            select.val(jQuery('option:first', select).val());
            
        });
        $("#sexoID").change( function(){
            $.ajax({async:true, 
                    data:$("#sexoID").serialize(), 
                    dataType:"html",
                    success:function (data, textStatus) {
                        $("#categoriaID").html(data);
                    },
                    type:"post",
                    url:"\/pecuaria/Categorias\/buscaCategoriasAnimais\/Relatorio\/" + $("#especieID option:selected").val()
            });
        });
    });
</script>




<?php
echo $this->Html->link($this->Html->image("botoes/retornar.png", array("alt" => "Retornar", "title" => "Retornar")), array('action' => 'index'), array('escape' => false, 'onclick' => 'history.go(-1); return false;'));
?>
<br>
<br>
<?php echo $this->Form->create('Categorialote'); ?>
<fieldset>
    <?php
    //debug($lotes);
    echo $this->Form->input('lote_id', array ('id' => 'loteID', 'type' => 'select', 'options' => $lotes, 'label' => 'Lote', 'empty' => '-- Selecione o lote --', 'value' => ''));
    echo $this->Form->input('especie_id', array ('id' => 'especieID', 'type' => 'select', 'label' => 'Espécie', 'empty' => ''));
    echo $this->Form->input('categoria_id', array('id' => 'categoriaID', 'type' => 'select', 'label' => 'Categoria', 'empty' => ' '));
    echo $this->Form->input('potreiro_id', array ('id' => 'potreiroID', 'type' => 'select', 'options' => $potreiros, 'label' => 'Potreiro', 'empty' => '-- Selecione o potreiro --'));
    
    echo $this->Form->input('selecionatodos', array(
        'before' => '<br>',
        'type' => 'checkbox',
        'onclick' => 'seleciona()',
        'value' => 'S',
        'hiddenField' => 'N',
        'label' => 'Selecionar todos os animais',
        'id' => 'selecionatodos',
    )); 
    echo $this->Form->input('Animai.Animai',array('id' => 'animalID', 'title' => 'CTRL + Click (para selecionar mais de um)', 'label'=>'Selecione os animais', 'type'=>'select', 'multiple'=>true));
    ?>
</fieldset>
<?php echo $this->Form->end(__('Montar lote')); ?>

<?php
$this->Js->get('#loteID')->event(
    'change',
    $this->Js->request(
        array('controller' => 'Especies', 'action' => 'buscaTodasEspecies'),
        array(  'update' => '#especieID',
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

$this->Js->get('#categoriaID')->event(
    'change',
    $this->Js->request(
        array('controller' => 'Animais', 'action' => 'buscaAnimais', 'Categorialote'),
        array(  'update' => '#animalID',
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
    
    function seleciona() { 
        
        var oSelect = document.getElementById("animalID");
        
        if ($('#selecionatodos').is(':checked')) {
            for( var i = 0; i < oSelect.getElementsByTagName("option").length; i++ ) {
                oSelect.getElementsByTagName("option")[i].selected = "selected";
            }
        } else {
            for( var i = 0; i < oSelect.getElementsByTagName("option").length; i++ ) {
                oSelect.getElementsByTagName("option")[i].selected = false;
            }
        }
        
    } 
    
    jQuery(document).ready(function(){
        
        $('#loteID').focus();
        
        $("#especieID").change( function(){
            $.ajax({async:true, 
                    data:$("#especieID").serialize(), 
                    dataType:"html", 
                    success:function (data, textStatus) {
                        $("#categoriaID").html(data);
                    }, 
                    type:"post", 
                    url:"\/pecuaria/categorias\/buscaCategorias\/Categorialote\/" + $("#loteID option:selected").val()
            });
        });
        
    });
</script>



<script> 

</script> 



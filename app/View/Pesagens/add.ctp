<?php
echo $this->Html->link($this->Html->image("botoes/retornar.png", array("alt" => "Retornar", "title" => "Retornar")), array('action' => 'index'), array('escape' => false, 'onclick' => 'history.go(-1); return false;'));
?>
<br>
<br>
<?php echo $this->Form->create('Pesagen'); ?>
<fieldset>
    <?php
    echo $this->Form->input('lote_id', array ('id' => 'loteID', 'type' => 'select', 'options' => $lotes, 'label' => 'Lote', 'empty' => '-- Selecione o lote --', 'value' => ''));
    echo $this->Form->input('categoria_id', array('id' => 'categoriaID', 'type' => 'select', 'label' => 'Categoria', 'empty' => ' '));
    echo $this->Form->input('peso', array('id' => 'dosagem', 'type' => 'text', 'label' => 'Peso por animal'));
    echo $this->Form->input('dtpesagem', array('id' => 'dtpesagem', 'class' => 'data', 'type' => 'text', 'label' => 'Data da pesagem'));
    ?>
    <div id="categorialote">
        <?php
        echo $this->Form->input('categorialote_id', array('id' => 'categorialoteID'));
        ?>
    </div>
    <?php
    
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
    echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => $usuario));
    echo $this->Form->input('empresa_id', array('type' => 'hidden', 'value' => $empresa));
    ?>
</fieldset>
<?php echo $this->Form->end(__('Criar pesagem')); ?>

<?php
$this->Js->get('#loteID')->event(
    'change',
    $this->Js->request(
        array('controller' => 'Categorias', 'action' => 'buscaCategoriasLotes'),
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
        
        document.getElementById('categorialote').style.display = 'none';
        
        $('#loteID').focus();
        
        $("#dtpesagem").mask("99/99/9999");
        
        $(".data").datepicker({
            dateFormat: 'dd/mm/yy',
            dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
            dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
            dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
            monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
            monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
            nextText: 'Próximo',
            prevText: 'Anterior'
        });
        
        $("#categoriaID").change( function(){
            $.ajax({async:true, 
                    data:$("#categoriaID").serialize(), 
                    dataType:"html",
                    success:function (data, textStatus) {
                        $("#categorialoteID").html(data);
                    },
                    type:"post",
                    url:"\/pecuaria/categorialotes\/buscaId\/Pesagen\/" + $("#loteID option:selected").val()
            });
        });
        
        $("#categoriaID").change( function(){
            $.ajax({async:true, 
                    data:$("#categoriaID").serialize(), 
                    dataType:"html",
                    success:function (data, textStatus) {
                        $("#animalID").html(data);
                    },
                    type:"post",
                    url:"\/pecuaria/Categorialotes\/buscaAnimaisLote\/Pesagen\/" + $("#loteID option:selected").val()
            });
        });
        
    });
</script>



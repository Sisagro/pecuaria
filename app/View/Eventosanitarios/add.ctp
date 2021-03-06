<?php
echo $this->Html->link($this->Html->image("botoes/retornar.png", array("alt" => "Retornar", "title" => "Retornar")), array('action' => 'index'), array('escape' => false, 'onclick' => 'history.go(-1); return false;'));
?>
<br>
<br>
<?php echo $this->Form->create('Eventosanitario'); ?>
<fieldset>
    <?php
    echo $this->Form->input('grpeventosanitario_id', array ('id' => 'grupomedID', 'type' => 'select', 'options' => $grpeventosanitarios, 'label' => 'Grupo de evento sanitário', 'empty' => '-- Selecione o grupo --', 'value' => ''));
    echo $this->Form->input('medicamento_id', array('id' => 'medicamentoID', 'type' => 'select', 'label' => 'Medicamento', 'empty' => ' '));
    echo $this->Form->input('dosagem', array('id' => 'dosagem', 'type' => 'text', 'label' => 'Dosagem (ml)'));
    echo $this->Form->input('lote_id', array ('id' => 'loteID', 'type' => 'select', 'options' => $lotes, 'label' => 'Lote', 'empty' => '-- Selecione o lote --', 'value' => ''));
    echo $this->Form->input('categoria_id', array('id' => 'categoriaID', 'type' => 'select', 'label' => 'Categoria', 'empty' => ' '));
    echo $this->Form->input('dtevento', array('id' => 'dtevento', 'class' => 'data', 'type' => 'text', 'label' => 'Data do evento sanitário'));
    echo $this->Form->input('valor', array('id' => 'valor', 'type' => 'text', 'label' => 'Valor do evento sanitário'));
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
    echo $this->Form->input('observacao', array('id' => 'obs', 'type' => 'textarea',  'label' => 'Observação'));
    echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => $usuario));
    echo $this->Form->input('empresa_id', array('type' => 'hidden', 'value' => $empresa));
    ?>
</fieldset>
<?php echo $this->Form->end(__('Criar evento sanitário')); ?>

<?php
$this->Js->get('#loteID')->event(
    'change',
    $this->Js->request(
        array('controller' => 'Categorias', 'action' => 'buscaCategoriasLotes', 'Eventosanitario'),
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
$this->Js->get('#grupomedID')->event(
    'change',
    $this->Js->request(
        array('controller' => 'Medicamentos', 'action' => 'buscaMedicamentos', 'Eventosanitario'),
        array(  'update' => '#medicamentoID',
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
        
        $('#grupomedID').focus();
        
        $("#valor").maskMoney({showSymbol:false, decimal:",", thousands:"", precision:2});
        
        $("#dtevento").mask("99/99/9999");
        
        $("#dosagem").maskMoney({showSymbol:false, decimal:",", thousands:"", precision:3});
        
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
                    url:"\/pecuaria/categorialotes\/buscaId\/Eventosanitario\/" + $("#loteID option:selected").val()
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
                    url:"\/pecuaria/Categorialotes\/buscaAnimaisLote\/Eventosanitario\/" + $("#loteID option:selected").val()
            });
        });
        
    });
</script>



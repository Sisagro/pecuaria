<?php
echo $this->Html->link($this->Html->image("botoes/retornar.png", array("alt" => "Retornar", "title" => "Retornar")), array('action' => 'index'), array('escape' => false, 'onclick' => 'history.go(-1); return false;'));
?>
<br>
<br>
<?php echo $this->Form->create('Eventoalimentacao'); ?>
<fieldset>
    <?php
    echo $this->Form->input('alimentacao_id', array ('id' => 'alimentacaoID', 'type' => 'select', 'options' => $alimentacaos, 'label' => 'Alimentação', 'empty' => '-- Selecione a alimentação --', 'value' => ''));
    echo $this->Form->input('lote_id', array ('id' => 'loteID', 'type' => 'select', 'options' => $lotes, 'label' => 'Lote', 'empty' => '-- Selecione o lote --', 'value' => ''));
    echo $this->Form->input('categoria_id', array('id' => 'categoriaID', 'type' => 'select', 'label' => 'Categoria', 'empty' => ' '));
    echo $this->Form->input('dtalimentacao', array('id' => 'dtalimentacao', 'class' => 'data', 'type' => 'text', 'label' => 'Data da alimentação'));
    echo $this->Form->input('valor', array('id' => 'valor', 'type' => 'text', 'label' => 'Valor da alimentação'));
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
<?php echo $this->Form->end(__('Criar alimentação')); ?>

<?php
$this->Js->get('#loteID')->event(
    'change',
    $this->Js->request(
        array('controller' => 'Categorias', 'action' => 'buscaCategoriasLotes', 'Eventoalimentacao'),
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

$this->Js->get('#alimentacaoID')->event(
    'change',
    $this->Js->request(
        array('controller' => 'Eventoalimentacaos', 'action' => 'buscaEventoalimentacaos', 'Alimentacao'),
        array(  'update' => '#eventoalimentacaoID',
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
        
        $('#alimentacaoID').focus();
        
        $("#valor").maskMoney({showSymbol:false, decimal:",", thousands:"", precision:2});
        
        $("#dtalimentacao").mask("99/99/9999");
        
        $("#peso").maskMoney({showSymbol:false, decimal:",", thousands:"", precision:3});
        
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
                    url:"\/pecuaria/categorialotes\/buscaId\/Eventoalimentacao\/" + $("#loteID option:selected").val()
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
                    url:"\/pecuaria/Categorialotes\/buscaAnimaisLote\/Eventoalimentacao\/" + $("#loteID option:selected").val()
            });
        });
                
    });
</script>



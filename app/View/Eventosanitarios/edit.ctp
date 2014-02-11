<?php
echo $this->Html->link($this->Html->image("botoes/retornar.png", array("alt" => "Retornar", "title" => "Retornar")), array('action' => 'index'), array('escape' => false, 'onclick' => 'history.go(-1); return false;'));
?>
<br>
<br>
<?php echo $this->Form->create('Eventosanitario'); ?>
<fieldset>
    <?php
    echo $this->Form->input('dosagem', array('id' => 'dosagem', 'type' => 'text', 'label' => 'Dosagem (ml)'));
    echo $this->Form->input('dtevento', array('id' => 'dtevento', 'class' => 'data', 'type' => 'text', 'label' => 'Data do evento sanitário'));
    echo $this->Form->input('observacao', array('id' => 'dosagem', 'type' => 'textarea',  'label' => 'Observação'));
    ?>
</fieldset>
<?php echo $this->Form->end(__('Altera evento sanitário')); ?>

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
    jQuery(document).ready(function(){
        
        $('#dosagem').focus();
        
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
        
    });
</script>



<?php
echo $this->Html->link($this->Html->image("botoes/retornar.png", array("alt" => "Retornar", "title" => "Retornar")), array('action' => 'index'), array('escape' => false, 'onclick' => 'history.go(-1); return false;'));
?>
<br>
<br>
<?php echo $this->Form->create('Pesagen'); ?>
<fieldset>
    <?php
    echo $this->Form->input('peso', array('id' => 'peso', 'type' => 'text', 'label' => 'Peso por animal'));
    echo $this->Form->input('dtpesagem', array('id' => 'dtpesagem', 'class' => 'data', 'type' => 'text', 'label' => 'Data da pesagem'));
    echo $this->Form->input('observacao', array('id' => 'obs', 'type' => 'textarea',  'label' => 'Observação'));
    ?>
</fieldset>
<?php echo $this->Form->end(__('Altera pesagem')); ?>

<script type="text/javascript">
    jQuery(document).ready(function(){
        
        $('#peso').focus();
        
        $("#dtpesagem").mask("99/99/9999");
        
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
        
    });
</script>



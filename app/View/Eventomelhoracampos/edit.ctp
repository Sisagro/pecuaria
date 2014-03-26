<?php
echo $this->Html->link($this->Html->image("botoes/retornar.png", array("alt" => "Retornar", "title" => "Retornar")), array('action' => 'index'), array('escape' => false, 'onclick' => 'history.go(-1); return false;'));
?>
<br>
<br>
<?php echo $this->Form->create('Eventomelhoracampo'); ?>
<fieldset>
    <?php
    echo $this->Form->input('melhoracampo_id', array ('id' => 'melhoracampoID', 'type' => 'select','options' => $melhoracampos, 'label' => 'Melhoria de campo', 'empty' => ''));
//    echo $this->Form->input('potreiro_id', array ('id' => 'potreiro', 'type' => 'select','options' => $potreiros, 'label' => 'Potreiro', 'empty' => ''));
    echo $this->Form->input('dtmelhoria', array('id' => 'dtevento', 'class' => 'data', 'type' => 'text', 'label' => 'Data da melhoria'));
    echo $this->Form->input('dtvalidade', array('id' => 'dtevento', 'class' => 'data', 'type' => 'text', 'label' => 'Validade da melhoria'));
    echo $this->Form->input('observacao', array('id' => 'observacao', 'type' => 'textarea',  'label' => 'Observação'));
    ?>
</fieldset>
<?php echo $this->Form->end(__('Editar')); ?>

<script type="text/javascript">
    jQuery(document).ready(function(){
        
        $('#melhoracampoID').focus();
        
        $("#dtevento").mask("99/99/9999");
               
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
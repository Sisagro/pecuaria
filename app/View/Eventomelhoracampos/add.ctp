<?php
echo $this->Html->link($this->Html->image("botoes/retornar.png", array("alt" => "Retornar", "title" => "Retornar")), array('action' => 'index'), array('escape' => false, 'onclick' => 'history.go(-1); return false;'));
?>
<br>
<br>
<?php echo $this->Form->create('Eventomelhoracampo'); ?>
<fieldset>
    <?php
    echo $this->Form->input('melhoracampo_id', array ('id' => 'melhoracampoID', 'type' => 'select','options' => $melhoracampos, 'label' => 'Melhoramento de campo', 'empty' => '-- Selecione o melhoramento de campo --'));
    echo $this->Form->input('potreiro_id', array ('id' => 'potreiroID', 'type' => 'select','options' => $potreiros, 'label' => 'Potreiro', 'empty' => '-- Selecione o potreiro --'));
    echo $this->Form->input('empresa_id', array('type' => 'hidden', 'value' => $empresa));
    echo $this->Form->input('dtmelhoria', array('id' => 'dtmelhoria', 'class' => 'data', 'type' => 'text', 'label' => 'Data da melhoria de campo'));
    echo $this->Form->input('dtvalidade', array('id' => 'dtvalidade', 'class' => 'data', 'type' => 'text', 'label' => 'Validade da melhoria de campo'));
    echo $this->Form->input('valor', array('id' => 'valor', 'type' => 'text', 'label' => 'Valor da melhoria de campo'));
    echo $this->Form->input('observacao', array('id' => 'observacao', 'type' => 'textarea',  'label' => 'Observação'));
    ?>
</fieldset>
<?php echo $this->Form->end(__('Adicionar')); ?>

<script type="text/javascript">
    
    jQuery(document).ready(function(){
        
        $('#melhoracampoID').focus();
        
        $("#valor").maskMoney({showSymbol:false, decimal:",", thousands:"", precision:2});

        $("#dtmelhoria").mask("99/99/9999");

        $("#dtvalidade").mask("99/99/9999");

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
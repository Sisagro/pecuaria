<?php
echo $this->Html->link($this->Html->image("botoes/retornar.png", array("alt" => "Retornar", "title" => "Retornar")), array('action' => 'index'), array('escape' => false));
?>
<br>
<br>
<?php echo $this->Form->create('Holding'); ?>
<fieldset>
    <?php
    echo $this->Form->input('nome');
    echo $this->Form->input('responsavel');
    echo $this->Form->input('contato');
    ?>
    <div class="input text required">
        <label for="datepicker">Data de validade</label>
        <input name="datepicker" type="text" class="datepicker" id="datepicker" title="Informe a data" required="required">
    </div>
</fieldset>
<?php echo $this->Form->end(__('Adicionar')); ?>
<script type="text/javascript">
    jQuery(document).ready(function(){
        $(".datepicker").datepicker({
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
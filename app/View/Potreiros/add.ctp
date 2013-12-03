<?php
echo $this->Html->link($this->Html->image("botoes/retornar.png", array("alt" => "Retornar", "title" => "Retornar")), array('action' => 'index'), array('escape' => false));
?>
<br>
<br>
<?php echo $this->Form->create('Potreiro'); ?>
<fieldset>
    <?php
    echo $this->Form->input('descricao');
    echo $this->Form->input('area_potreiro', array('id' => 'potreiro',  'type' => 'text', 'label' => 'Área potreiro', 'maxlength' => '10'));
    echo $this->Form->input('area_lavoura', array('id' => 'lavoura',  'type' => 'text', 'label' => 'Área lavoura', 'maxlength' => '10', 'required' => 'false'));
    echo $this->Form->input('empresa_id', array('type' => 'hidden', 'value' => $empresa_id));
    ?>
</fieldset>
<?php echo $this->Form->end(__('Adicionar')); ?>

<script type="text/javascript">
    jQuery(document).ready(function($){
        $("#potreiro").maskMoney({showSymbol:false, decimal:",", thousands:"", precision:4});
        $("#lavoura").maskMoney({showSymbol:false, decimal:",", thousands:"", precision:4});
    });
</script>

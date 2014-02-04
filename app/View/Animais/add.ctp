<?php
echo $this->Html->link($this->Html->image("botoes/retornar.png", array("alt" => "Retornar", "title" => "Retornar")), array('action' => 'index'), array('escape' => false, 'onclick' => 'history.go(-1); return false;'));
?>
<br>
<br>
<?php echo $this->Form->create('Animai'); ?>
<fieldset>
    <?php
    echo $this->Form->input('especie_id', array ('id' => 'especieID', 'type' => 'select','options' => $especies, 'label' => 'Espécie', 'empty' => '-- Selecione a espécie --'));
    echo $this->Form->input('categoria_id', array('id' => 'categoriaID', 'type' => 'select', 'label' => 'Categoria'));
    echo $this->Form->input('raca_id', array('id' => 'racaID', 'type' => 'select', 'label' => 'Raça'));
    echo $this->Form->input('pelagen_id', array('id' => 'pelagenID', 'type' => 'select', 'label' => 'Pelagem'));
    echo $this->Form->input('grausangue_id', array ('id' => 'grausangueID', 'type' => 'select','options' => $grausangues, 'label' => 'Grau de sangue', 'empty' => '-- Selecione o grau de sangue --'));
    ?>
    <div class="fomr_checkbox_animais">
        <label>Identificação</label><br>
        <input type="checkbox" name="brinco" id="brinco" value="check" onclick="myfunction(this);" > Brinco
        <input type="checkbox" name="chip" id="chip" value="check" onclick="myfunction(this);"> Chip eletrônico
        <input type="checkbox" name="colar" id="colar" value="check" onclick="myfunction(this);"> Colar Eletrônico
        <input type="checkbox" name="tatuagem" id="tatuagem" value="check" onclick="myfunction(this);"> Tatuagem
        <input type="checkbox" name="cor" id="cor" value="check" onclick="myfunction(this);"> Cor
    </div>
    <div id="formMostraBrinco">
        <?php echo $this->Form->input('brinco', array ('id' => 'brincoInput', 'label' => 'Brinco')); ?>
    </div>
    <div id="formMostraChip">
        <?php echo $this->Form->input('chipeletronico', array ('id' => 'chipeletronicoInput', 'label' => 'Chip eletrônico')); ?>
    </div>
    <div id="formMostraColar">
        <?php echo $this->Form->input('colareletronico', array ('id' => 'colareletronicoInput', 'label' => 'Colar eletrônico')); ?>
    </div>
    <div id="formMostraTatuagem">
        <?php echo $this->Form->input('tatuagem', array ('id' => 'tatuagemInput', 'label' => 'Tatuagem')); ?>
    </div>
    <div id="formMostraCor">
        <?php echo $this->Form->input('cor', array ('id' => 'corPlugin', 'label' => 'Cor')); ?>
    </div>
    <?php
    
    // identificacao (brinco - chipeletronico - colareletronico - tatuagem - cor)
    echo $this->Form->input('sexo', array ('id' => 'sexo', 'type' => 'select', 'options' => $sexos, 'label' => 'Sexo', 'empty' => '-- Selecione o sexo --'));
    echo $this->Form->input('dtnasc', array('id' => 'dtnasc', 'class' => 'data', 'type' => 'text', 'label' => 'Data de nascimento'));
    echo $this->Form->input('dtcomprado', array('id' => 'dtcomprado', 'class' => 'data', 'type' => 'text', 'label' => 'Data de compra'));
    echo $this->Form->input('hbbsbb', array ('id' => 'hbbsbb', 'label' => 'HBB/SBB'));
    echo $this->Form->input('caracteristica', array ('id' => 'caracteristica', 'type' => 'textarea', 'label' => 'Características', 'escape' => false));
    echo $this->Form->input('causabaixa_id', array ('id' => 'causabaixaID', 'type' => 'select','options' => $causabaixas, 'label' => 'Causa de baixa', 'empty' => '-- Selecione a causa de baixa --'));
    echo $this->Form->input('ativo', array ('id' => 'ativo', 'type' => 'select','options' => $status, 'label' => 'Ativo'));
    echo $this->Form->input('empresa_id', array('type' => 'hidden', 'value' => $empresa_id));
    ?>
</fieldset>
<?php echo $this->Form->end(__('Adicionar')); ?>

<?php
$this->Js->get('#especieID')->event(
    'change',
    $this->Js->request(
        array('controller' => 'Categorias', 'action' => 'buscaCategorias', 'Animai'),
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
$this->Js->get('#especieID')->event(
    'change',
    $this->Js->request(
        array('controller' => 'Racas', 'action' => 'buscaRacas', 'Animai'),
        array(  'update' => '#racaID',
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
$this->Js->get('#racaID')->event(
    'change',
    $this->Js->request(
        array('controller' => 'Pelagens', 'action' => 'buscaPelagens', 'Animai'),
        array(  'update' => '#pelagenID',
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
    
    function myfunction(obj){
        if (obj.checked) {
            if (obj.name == "brinco") {
                $("#formMostraBrinco").show();
                document.getElementById('brincoInput').focus();
            } else if (obj.name == "chip") {
                $("#formMostraChip").show();
                document.getElementById('chipeletronicoInput').focus();
            } else if (obj.name == "colar") {
                $("#formMostraColar").show();
                document.getElementById('colareletronicoInput').focus();
            } else if (obj.name == "tatuagem") {
                $("#formMostraTatuagem").show();
                document.getElementById('tatuagemInput').focus();
            } else if (obj.name == "cor") {
                $("#formMostraCor").show();
                document.getElementById('corPlugin').focus();
            }
        } else {
            if (obj.name == "brinco") {
                $("#formMostraBrinco").hide();
            } else if (obj.name == "chip") {
                $("#formMostraChip").hide();
            } else if (obj.name == "colar") {
                $("#formMostraColar").hide();
            } else if (obj.name == "tatuagem") {
                $("#formMostraTatuagem").hide();
            } else if (obj.name == "cor") {
                $("#formMostraCor").hide();
            }
        }
    }
    
    jQuery(document).ready(function(){
        $("#dtnasc").mask("99/99/9999");
        $("#dtcomprado").mask("99/99/9999");
        document.getElementById('especieID').focus();
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
        
        $('#corPlugin').ColorPicker({
            onSubmit: function(hsb, hex, rgb, el) {
                 $(el).val(hex);
                 $(el).ColorPickerHide();
            },
            onBeforeShow: function () {
                 $(this).ColorPickerSetColor(this.value);
            }
            })
            .bind('keyup', function(){
            $(this).ColorPickerSetColor(this.value);
            });
        
        
        
        $("#formMostraBrinco").hide();
        $("#formMostraChip").hide();
        $("#formMostraColar").hide();
        $("#formMostraTatuagem").hide();
        $("#formMostraCor").hide();
        
    });
</script>




<?php
echo $this->Html->link($this->Html->image("botoes/retornar.png", array("alt" => "Retornar", "title" => "Retornar")), array('action' => 'index'), array('escape' => false));
?>
<br>
<br>
<?php echo $this->Form->create('Animai'); ?>
<fieldset>
    <?php
    echo $this->Form->input('grausangue_id', array ('id' => 'grausangueID', 'type' => 'select','options' => $grausangues, 'label' => 'Grau de sangue', 'empty' => '-- Selecione o grau de sangue --'));
    ?>
    <div class="fomr_checkbox_animais">
        <label>Identificação</label><br>
        <input type="checkbox" name="brinco" id="brinco" value="check" onclick="myfunction(this);" > Brinco
        <input type="checkbox" name="tatuagem" id="tatuagem" value="check" onclick="myfunction(this);"> Tatuagem
        <input type="checkbox" name="hbbsbb" id="hbbsbb" value="check" onclick="myfunction(this);"> HBB/SBB/FBB
        <input type="checkbox" name="chip" id="chip" value="check" onclick="myfunction(this);"> Chip eletrônico
        <input type="checkbox" name="colar" id="colar" value="check" onclick="myfunction(this);"> Colar Eletrônico
        <input type="checkbox" name="cor" id="cor" value="check" onclick="myfunction(this);"> Cor
    </div>
    <div id="formMostraBrinco">
        <?php echo $this->Form->input('brinco', array ('id' => 'brincoInput', 'label' => 'Brinco')); ?>
    </div>
    <div id="formMostraTatuagem">
        <?php echo $this->Form->input('tatuagem', array ('id' => 'tatuagemInput', 'label' => 'Tatuagem')); ?>
    </div>
    <div id="formMostraHBBSBB">
        <?php echo $this->Form->input('hbbsbb', array ('id' => 'hbbsbbInput', 'label' => 'HBB/SBB/FBB')); ?>
    </div>
    <div id="formMostraChip">
        <?php echo $this->Form->input('chipeletronico', array ('id' => 'chipeletronicoInput', 'label' => 'Chip eletrônico')); ?>
    </div>
    <div id="formMostraColar">
        <?php echo $this->Form->input('colareletronico', array ('id' => 'colareletronicoInput', 'label' => 'Colar eletrônico')); ?>
    </div>
    <div id="formMostraCor">
        &nbsp;Cor:<br>
        <div id="colorSelector">
            <div style="background-color: #<?php echo $coranimal; ?>">
            </div>
        </div>
    </div>
    <div id="coranimal">
        <?php echo $this->Form->input('cor', array ('id' => 'corAnimal', 'label' => 'Cor')); ?>
    </div>
    
    <?php
    echo $this->Form->input('dtnasc', array('id' => 'dtnasc', 'class' => 'data', 'type' => 'text', 'label' => 'Data de nascimento'));
    echo $this->Form->input('dtcomprado', array('id' => 'dtcomprado', 'class' => 'data', 'type' => 'text', 'label' => 'Data de compra'));
    echo $this->Form->input('caracteristica', array ('id' => 'caracteristica', 'type' => 'textarea', 'label' => 'Características', 'escape' => false));
    //echo $this->Form->input('causabaixa_id', array ('id' => 'causabaixaID', 'type' => 'select','options' => $causabaixas, 'label' => 'Causa de baixa', 'empty' => '-- Selecione a causa de baixa --'));
    //echo $this->Form->input('ativo', array ('id' => 'ativo', 'type' => 'select','options' => $status, 'label' => 'Ativo'));
    echo $this->Form->input('empresa_id', array('type' => 'hidden', 'value' => $empresa_id));
    ?>
</fieldset>
<?php echo $this->Form->end(__('Editar')); ?>

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
            } else if (obj.name == "hbbsbb") {
                $("#formMostraHBBSBB").show();
                document.getElementById('hbbsbbInput').focus();
            }
        } else {
            if (obj.name == "brinco") {
                $("#formMostraBrinco").hide();
                document.getElementById('brincoInput').value = '';
            } else if (obj.name == "chip") {
                $("#formMostraChip").hide();
                document.getElementById('chipeletronicoInput').value = '';
            } else if (obj.name == "colar") {
                $("#formMostraColar").hide();
                document.getElementById('colareletronicoInput').value = '';
            } else if (obj.name == "tatuagem") {
                $("#formMostraTatuagem").hide();
                document.getElementById('tatuagemInput').value = '';
            } else if (obj.name == "cor") {
                $("#formMostraCor").hide();
                document.getElementById('corAnimal').value = '';
            } else if (obj.name == "hbbsbb") {
                $("#formMostraHBBSBB").hide();
                document.getElementById('hbbsbbInput').value = '';
            }
        }
    }
    
    jQuery(document).ready(function(){
        
        $("#dtnasc").mask("99/99/9999");
        $("#dtcomprado").mask("99/99/9999");
        $("#coranimal").hide();
        
        document.getElementById('grausangueID').focus();
        
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
        
        $('#colorSelector').ColorPicker({
            color: '#0000ff',
            onShow: function (colpkr) {
                $(colpkr).fadeIn(500);
                return false;
            },
            onHide: function (colpkr) {
                $(colpkr).fadeOut(500);
                return false;
            },
            onChange: function (hsb, hex, rgb) {
                $('#colorSelector div').css('backgroundColor', '#' + hex);
                $('#corAnimal').val(hex);

            }
        });
        
        if (document.getElementById("brincoInput").value === "")  {      
            $("#formMostraBrinco").hide();
        } else {
            document.getElementById("brinco").checked = true;
        }
        
        if (document.getElementById("chipeletronicoInput").value === "")  {      
            $("#formMostraChip").hide();
        } else {
            document.getElementById("chip").checked = true;
        }
        
        if (document.getElementById("colareletronicoInput").value === "")  {      
            $("#formMostraColar").hide();
        } else {
            document.getElementById("colar").checked = true;
        }
        
        if (document.getElementById("tatuagemInput").value === "")  {      
            $("#formMostraTatuagem").hide();
        } else {
            document.getElementById("tatuagem").checked = true;
        }
        
        if (document.getElementById("corAnimal").value === "")  {      
            $("#formMostraCor").hide();  
        } else {
            document.getElementById("cor").checked = true;
        }
        
        if (document.getElementById("hbbsbbInput").value === "")  {      
            $("#formMostraHBBSBB").hide();  
        } else {
            document.getElementById("hbbsbb").checked = true;
        }
        
    });
</script>

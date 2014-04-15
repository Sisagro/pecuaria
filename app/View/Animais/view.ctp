<?php
echo $this->Html->link($this->Html->image("botoes/retornar.png", array("alt" => "Retornar", "title" => "Retornar")), array('action' => 'index'), array('escape' => false, 'onclick' => 'history.go(-1); return false;'));
echo $this->Form->postLink($this->Html->image('botoes/excluir.png', array('alt' => 'Exluir', 'title' => 'Exluir')), array('action' => 'delete', $animal['Animai']['id']), array('escape' => false), __('Você realmete deseja apagar esse item?'));
?>
<br>
<br>
<p>
<strong> Espécie: </strong>
<?php echo $animal['Especy']['descricao']; ?>
<br>
<strong> Pelagem: </strong>
<?php echo $animal['Pelagen']['descricao']; ?>
<br>
<strong> Categoria: </strong>
<?php echo $animal['Categoria']['descricao']; ?>
<br>
<strong> Sexo: </strong>
<?php if($animal['Categoria']['sexo'] == "M") { echo "Macho"; } else { echo "Fêmea"; } ; ?>
<br>
<strong> Grau de sangue: </strong>
<?php echo $animal['Grausangue']['descricao']; ?>
<br>
<strong> Data de nascimento: </strong>
<?php echo $animal['Animai']['dtnasc']; ?>
<br>
<strong> Data de compra: </strong>
<?php echo $animal['Animai']['dtcomprado']; ?>
<br>
<strong> Características: </strong>
<?php echo $animal['Animai']['caracteristica']; ?>
<br>
<strong> Causa de baixa: </strong>
<?php echo $animal['Causabaixa']['descricao']; ?>
<br>
<strong> Ativo: </strong>
<?php if($animal['Animai']['ativo'] == "A") { echo "SIM"; } else { echo "NÃO"; } ; ?>
<br>
<strong> Brinco: </strong>
<?php echo $animal['Animai']['brinco']; ?>
<br>
<strong> Tatuagem: </strong>
<?php echo $animal['Animai']['tatuagem']; ?>
<br>
<strong> HBB/SBB/FBB: </strong>
<?php echo $animal['Animai']['hbbsbb']; ?>
<br>
<strong> Chip eletrônico: </strong>
<?php echo $animal['Animai']['chipeletronico']; ?>
<br>
<strong> Colar eletrônico: </strong>
<?php echo $animal['Animai']['colareletronico']; ?>
<br>
<strong> Cor: </strong>
<br>
<?php
if (!empty($animal['Animai']['cor'])) {
    ?>
    <div id="colorSelector">
        <div style="background-color: #<?php echo $animal['Animai']['cor']; ?>"></div>
    </div>
    <?php
}
?>
</p>
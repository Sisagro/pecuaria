<?php
echo $this->Html->link($this->Html->image("botoes/retornar.png", array("alt" => "Retornar", "title" => "Retornar")), array('action' => 'index'), array('escape' => false));
echo $this->Form->postLink($this->Html->image('botoes/excluir.png', array('alt' => 'Exluir', 'title' => 'Exluir')), array('action' => 'delete', $empresa['Empresa']['id']), array('escape' => false), __('Você realmete deseja apagar esse item?'));
?>
<br>
<br>
<p>
    Razão social: 
    <?php echo $empresa['Empresa']['razaosocial']; ?>
    <br>
    Nome fantasia: 
    <?php echo $empresa['Empresa']['nomefantasia']; ?>
    <br>
    CNPJ: 
    <?php echo substr($empresa['Empresa']['cnpj'],0,3) . "." . 
               substr($empresa['Empresa']['cnpj'],3,3) . "." . 
               substr($empresa['Empresa']['cnpj'],6,3) . "/" . 
               substr($empresa['Empresa']['cnpj'],9,4) . "-" . 
               substr($empresa['Empresa']['cnpj'],13,2); ?>
    <br>
    Inscrição estadual:
    <?php echo substr($empresa['Empresa']['inscestadual'],0,3) . "/" . 
               substr($empresa['Empresa']['inscestadual'],3,7); ?>
    <br>
    Inscrição municipal:
    <?php echo substr($empresa['Empresa']['inscmunicipal'],0,3) . "/" . 
               substr($empresa['Empresa']['inscmunicipal'],3,7); ?>
    <br>
    E-mail: 
    <?php echo $empresa['Empresa']['email']; ?>
    <br>
    Homepage: 
    <?php echo $empresa['Empresa']['homepage']; ?>
    <br>
    Última modifiação: 
    <?php echo date('d/m/Y', strtotime($empresa['Empresa']['modified'])); ?>
    <br>
    Criação: 
    <?php echo date('d/m/Y', strtotime($empresa['Empresa']['created'])); ?>
    <br>
</p>
<?php unset($group); ?>

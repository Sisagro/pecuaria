<?php
echo $this->Html->link($this->Html->image("botoes/retornar.png", array("alt" => "Retornar", "title" => "Retornar")), array('action' => 'index'), array('escape' => false));
echo $this->Form->postLink($this->Html->image('botoes/excluir.png', array('alt' => 'Exluir', 'title' => 'Exluir')), array('action' => 'delete', $usergroupempresa['Usergroupempresa']['id']), array('escape' => false), __('Você realmete deseja apagar esse item?'));
?>
<br>
<br>
<p>
Usuário: 
<?php echo $usergroupempresa['User']['nome']; ?>
<br>
Empresa: 
<?php echo $usergroupempresa['Empresa']['nomefantasia']; ?>
<br>
Grupo:
<?php echo $usergroupempresa['Group']['name']; ?>
<br>
Empresa boot:
<?php if ($usergroupempresa['Usergroupempresa']['empresaboot'] == "1") { echo "SIM"; } else { echo "NAO"; }; ?>
<br>



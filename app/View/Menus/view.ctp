<?php
echo $this->Html->link($this->Html->image("botoes/retornar.png", array("alt" => "Retornar", "title" => "Retornar")), array('action' => 'index'), array('escape' => false));
echo $this->Form->postLink($this->Html->image('botoes/excluir.png', array('alt' => 'Exluir', 'title' => 'Exluir')), array('action' => 'delete', $menu['Menu']['id']), array('escape' => false), __('Você realmete deseja apagar esse item?'));
?>
<br>
<br>
<p>
<strong> Menu: </strong>
<?php echo $menu['Menu']['nome']; ?>
<br>
<strong> Controller: </strong>
<?php echo $menu['Menu']['controller']; ?>
<br>
<?php
if ($menu['Menu']['mostramenu'] == 1) {
    ?>
    <strong> Mostra no menu: </strong> SIM
    <br>
    <strong> Número do menu: </strong> <?php echo $menu['Menu']['menu']; ?>
    <br>
    <strong> Ordem do menu: </strong> <?php echo $menu['Menu']['ordem']; ?>
    <?php
} else {
    ?>
    <strong> Mostra no menu: </strong> NÃO
    <?php
}
?>
</p>
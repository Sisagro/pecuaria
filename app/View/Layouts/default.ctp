<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            .:: Sisagro <?php echo " - " . $title_for_layout . " "; ?> ::.

        </title>
	<?php
            //echo $this->Html->meta('icon');

            echo $this->Html->css('sisagro.default');
            echo $this->Html->css('jquery-ui-1.10.3.custom.min');
            
            echo $this->Html->script(array('jquery.js', 'gerais.js', 'jquery-ui.js', 'jquery.maskedinput.min.js'));

            echo $this->fetch('meta');
            echo $this->fetch('css');
            echo $this->fetch('script');
	?>
    </head>
    <body>
        
        <div id="global">

            <div id="diferenca">

            </div>

            <div id="topo">
                <div id="topoleft">
                    <?php
                    echo $this->Html->link($this->Html->image("marca.png", array("alt" => "Marca Cliente", "title" => "Marca Cliente")), array('controller' => 'homes', 'action' => 'index'), array('escape' => false) );
                    ?>
                </div>
                <div id="toporight">
                    <div id="marcacaoleft">
                        <div id="internadomenu">
                            <br></br>
                            Bem vindo, <span class="fontNomeUsuario"><b>Daniel</b></span>.
                            <br> <span class="fontUltimoAcesso">Seu último acesso foi: 15/01/2013 | 21:10</span> 
                            <br></br>

                                <select name="minutos" id="minutos" class="selectFazenda" title="Informe os minutos">
                                    <option value="1">Fazenda Santa Helena</option>
                                    <option value="2">Fazenda Santa Silvana</option>
                                </select>

                            <?php
                            echo $this->Html->link($this->Html->image("botoes/user_02.png", array("alt" => "Trocar empresa", "title" => "Trocar empresa")), array('controller' => 'homes', 'action' => 'index'), array('escape' => false) );
                            echo $this->Html->link($this->Html->image("botoes/logout_01.png", array("alt" => "Sair", "title" => "Sair")), array('controller' => 'homes', 'action' => 'index'), array('escape' => false) );
                            ?>
                        </div>
                    </div>
                    <div id="marcacaoright">
                        <?php
                        echo $this->Html->image("logo_sisagro.png", array("alt" => "Sisagro - Sistema Agropecuário", "title" => "Sisagro - Sistema Agropecuário"));
                        ?>
                    </div>
                    <br></br>
                    <?php echo $this->element('menu'); ?>
                </div>
            </div>

        
            <div id="conteudo">
                <div id="titulopagina">
                    <?php echo $title_for_layout; ?>
                </div>
                <div id="corpo">
                    <?php echo $this->element('navegacao'); ?>
                    <?php echo $this->Session->flash(); ?>
                    <?php echo $this->fetch('content'); ?>
                </div>

            </div>

            <div id="rodape">
                
            </div>
            
        </div>
        
    </body>
</html>

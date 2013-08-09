<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            .:: Sisagro - Autenticação ::.

        </title>
        <?php
        //echo $this->Html->meta('icon');

        echo $this->Html->css('sisagro.default');
        echo $this->Html->css('jquery-ui-1.10.3.custom.min');

        echo $this->Html->script(array('jquery.js'));

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
    </head>
    <body>

        <div id="global">

            <div id="diferenca">

            </div>

            <div id="naologado">
                
            </div>


        <div id="conteudo">
            
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

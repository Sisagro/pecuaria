<?php $this->layout = 'naoLogado'; ?>
<br>
<br>
<?php echo $this->Form->create('User', array('action' => 'login')); ?>

    <?php
    echo $this->Form->input('username');
    echo $this->Form->input('password');
    
    ?>
<?php echo $this->Form->end('Entrar'); ?>
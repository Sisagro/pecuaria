<ul id="jsddm">
    <li><a href="#">Administrativo</a>
        <ul>
            <li><?php echo $this->Html->link('Holdings', array('controller' => 'holdings', 'action' => 'index')); ?></li>
            <li><?php echo $this->Html->link('Empresas', array('controller' => 'empresas', 'action' => 'index')); ?></li>
            <li><?php echo $this->Html->link('Grupos', array('controller' => 'groups', 'action' => 'index')); ?></li>
            <li><?php echo $this->Html->link('Users', array('controller' => 'users', 'action' => 'index')); ?></li>
            <li><?php echo $this->Html->link('Vincular perfil', array('controller' => 'usergroupempresas', 'action' => 'index')); ?></li>
            <li><?php echo $this->Html->link('Menus', array('controller' => 'menus', 'action' => 'index')); ?></li>
        </ul>
    </li>
    <li><a href="#">Cadastros</a>
        <ul>
            <li><?php echo $this->Html->link('Empresas', array('controller' => 'empresas', 'action' => 'index')); ?></li>
            <li><?php echo $this->Html->link('Vincular perfil', array('controller' => 'usergroupempresas', 'action' => 'index')); ?></li>
        </ul>
    </li>
    <li><a href="#">Produção</a>
        <ul>
            <li><a href="#">Slide Effect</a></li>
            <li><a href="#">Fade Effect</a></li>
        </ul>
    </li>
    <li><a href="#">Reprodução</a>
        <ul>
            <li><a href="#">Slide Effect</a></li>
            <li><a href="#">Fade Effect</a></li>
        </ul>
    </li>
    <li><a href="#">Financeiro</a>
        <ul>
            <li><a href="#">Slide Effect</a></li>
            <li><a href="#">Fade Effect</a></li>
        </ul>
    </li>
    <li><a href="#">Rastreabilidade</a>
        <ul>
            <li><a href="#">Slide Effect</a></li>
            <li><a href="#">Fade Effect</a></li>
        </ul>
    </li>
</ul>
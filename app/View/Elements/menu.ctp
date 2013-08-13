<div id="menu">
    <ul id="jsddm">

        <?php
        
        $menu_1 = 0;
        $menu_2 = 0;
        $menu_3 = 0;
        $menu_4 = 0;
        $menu_5 = 0;
        $menu_6 = 0;
        
        //debug($menuCarregado);
        
        foreach ($menuCarregado as $itemMenu):
            
            if ($itemMenu['mostramenu'] == 1) {
            
                if ($itemMenu['menu'] === 1 && $menu_1 == 0) {
                    ?>
                    <li><a href="#">Administrativo</a>
                        <ul>
                    <?php
                    $menu_1++;
                } elseif ($itemMenu['menu'] === 2 && $menu_2 == 0) {
                    ?>
                        </ul>
                    </li>
                    <li><a href="#">Cadastros</a>
                        <ul>
                    <?php
                    $menu_2++;
                } elseif ($itemMenu['menu'] === 3 && $menu_3 == 0) {
                    ?>
                        </ul>
                    </li>
                    <li><a href="#">Produção</a>
                        <ul>
                    <?php
                    $menu_3++;
                } elseif ($itemMenu['menu'] === 4 && $menu_4 == 0) {
                    ?>
                        </ul>
                    </li>
                    <li><a href="#">Reprodução</a>
                        <ul>
                    <?php
                    $menu_4++;
                } elseif ($itemMenu['menu'] === 5 && $menu_5 == 0) {
                    ?>
                        </ul>
                    </li>
                    <li><a href="#">Financeiro</a>
                        <ul>
                    <?php
                    $menu_5++;
                } elseif ($itemMenu['menu'] === 6 && $menu_6 == 0) {
                    ?>
                        </ul>
                    </li>
                    <li><a href="#">Rastreabilidade</a>
                        <ul>
                    <?php
                    $menu_6++;
                }
            
                ?>
                <li><?php echo $this->Html->link($itemMenu['nome'], array('controller' => $itemMenu['controller'], 'action' => 'index')); ?></li>
                <?php
                
            }
            
            
            
        endforeach;
        
        ?>
                        
            </ul>
        </li>

    </ul>
</div>
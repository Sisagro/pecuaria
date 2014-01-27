<?php
    //echo "<option value=\"\"> -- Selecione a categoria --</option>";
    foreach($animais as $key => $subcat){ 
        echo "<option value=\"{$key}\">{$subcat}</option>";
    }
?>
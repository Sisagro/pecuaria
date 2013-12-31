<?php
    echo "<option value=\"\"> -- Selecione a raça --</option>";
    foreach($racas as $key => $subcat){ 
        echo "<option value=\"{$key}\">{$subcat}</option>";
    }
?>
<?php
    echo "<option value=\"\"> -- Selecione a espécie --</option>";
    foreach($especies as $key => $subcat){ 
        echo "<option value=\"{$key}\">{$subcat}</option>";
    }
    
?>
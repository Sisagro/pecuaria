<?php
    echo "<option value=\"\"> -- Selecione a melhoria de campo --</option>";
    foreach($eventomelhoracampos as $key => $subcat){ 
        echo "<option value=\"{$key}\">{$subcat}</option>";
    }
    
?>
<?php
    echo "<option value=\"\"> -- Selecione o medicamento --</option>";
    foreach($medicamentos as $key => $subcat){ 
        echo "<option value=\"{$key}\">{$subcat}</option>";
    }
?>
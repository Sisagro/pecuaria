<?php
    echo "<option value=\"\"> -- Selecione a alimentação --</option>";
    foreach($alimentacaos as $key => $subcat){ 
        echo "<option value=\"{$key}\">{$subcat}</option>";
    }
?>
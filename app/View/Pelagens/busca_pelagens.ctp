<?php
    echo "<option value=\"\"> -- Selecione a pelagem --</option>";
    foreach($pelagens as $key => $subcat){ 
        echo "<option value=\"{$key}\">{$subcat}</option>";
    }
?>
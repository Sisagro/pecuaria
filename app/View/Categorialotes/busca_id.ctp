<?php
    //echo "<option value=\"\"> -- Selecione a categoria --</option>";
    foreach($id as $key => $subcat){ 
        echo "<option value=\"{$key}\">{$subcat}</option>";
    }
    
?>
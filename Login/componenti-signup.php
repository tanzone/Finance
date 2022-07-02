<?php 
    
    function inputTextPersonalizzato($nomeInput){

        $valore_campo ;
        $stile_campo = "";

         if(!isset($_POST[$nomeInput]))
         {
             $valore_campo = "";
             $stile_campo = "";
         }

        else
        {
            $valore_campo = $_POST[$nomeInput];
            $stile_campo = "has-val";
        }
        
        if($nomeInput != "password")
            echo "<input class='input100 $stile_campo'  minlength='1' type='text' name='$nomeInput' value='$valore_campo' required>";
        else
            echo "<input class='input100 $stile_campo'  minlength='1' type='password' name='$nomeInput' value='$valore_campo' required>";

    }

?>
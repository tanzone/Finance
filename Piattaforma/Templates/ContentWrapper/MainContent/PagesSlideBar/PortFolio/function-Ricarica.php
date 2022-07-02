<?php 
function isRequestedFromForm()
    {
            if ($_SERVER['REQUEST_METHOD'] != 'POST') 
                return False;
            return True;
    }
    
    function isValidRequest(){
        if(!isset($_POST["credito"]))
            return False;
        return True;
    }    
    
    
    function LoadPageRic()
    {
        $_SESSION['ApriPaginaPost'] = "./Templates/ContentWrapper/MainContent/PagesSlideBar/PortFolio/Ricariche.php";

        if(!isRequestedFromForm() || !isValidRequest())
            return;
        
        $stringaCredito = "".$_POST["credito"];
        
        // MAX 9999 DI RICARICA IN UNA VOLTA
        if(!(strlen($stringaCredito) < 5 && strlen($stringaCredito) > 0 && isNumber($stringaCredito))){
            echo "<p class=\"cercaAzioni\" style='color : red;'>Saldo impossibile da Ricaricare correttamente</p>";
            return ;
        }
        
         ricaricaSaldo(cercaUser($_SESSION["username"]) , $_POST["credito"]);
        echo "<p  class=\"cercaAzioni\" style='color : green;'>Saldo caricato correttamente</p>";
    }

?>
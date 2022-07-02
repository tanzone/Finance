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
    
    
    function LoadPagePrel()
    {
        $_SESSION['ApriPaginaPost'] = "./Templates/ContentWrapper/MainContent/PagesSlideBar/PortFolio/Prelievo.php";

        if(!isRequestedFromForm() || !isValidRequest())
            return;

        $stringaCredito = "".$_POST["credito"];
        
        // MAX 9999 DI RICARICA IN UNA VOLTA
        if(!(strlen($stringaCredito) < 5 && strlen($stringaCredito) > 0 && isNumber($stringaCredito))){
            echo "<p class=\"cercaAzioni\" style='color : red;'>Cifra impossibile da Prelevare</p>";
            return ;
        }
        
        if(effettuaPrelievo(cercaUser($_SESSION["username"]) , $_POST["credito"]))
            echo "<p class=\"cercaAzioni\" style='color : green;'>Hai prelevato correttamente</p>";
        else
            echo "<p class=\"cercaAzioni\" style='color : red;'> Impossibile prelevare la cifra richiesta</p>";
        

        exit;
    }

?>
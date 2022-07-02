<?php 
    require("../includes/functions.php");

?>

<?php 
        
    
        function createNewUser($info)
        {
            $TABLE_utentiTrovati = cercaUser($info["username"]);
            
            if($TABLE_utentiTrovati != 0)
                return False;
            else
                addUserToDb($info);
            return True;
        }

function addUserToDb($info){
            $link = mysqli_connect(SERVER, USERNAME,PASSWORD, DATABASE);
            $sale     = mt_rand(0,9999999);
            $password = md5( $info["password"] . "" .$sale);
            $username = $info["username"];
            $email    = $info["email"];
            $saldo    = 0;
            
            $nome = $info["nome"];
            $cognome = $info["cognome"];
            $sesso =$info["sesso"];
    
            mysqli_query(
                $link,
                "INSERT INTO INFOUTENTE(NOME,COGNOME,SESSO)VALUES('$nome','$cognome','$sesso');"
            );
    
            $last_id = mysqli_insert_id($link);
    
            mysqli_query(
                $link,
                "INSERT INTO UTENTE(USERNAME,PASSWORD,SALT,EMAIL,SALDO,ID_InfoUtente)
                VALUES('$username','$password',$sale,'$email',$saldo, $last_id);"
            );

            return ;
}

// FUNZIONE CHE RICERCA LA COPPIA USERNAME E PASSWORD ALL'INTERNO DEL DATABASE
        function iniziaRicercaUserPsw($username , $password){
            
            $TABLE_utentiTrovati = cercaUser($username);

            if ($TABLE_utentiTrovati == 0) 
            {
                return False;
            }else
            {

                if( convalidaUser($username , $password,$TABLE_utentiTrovati))
                    return True;
                return False;

            }
        }
        
        function cercaUser($username)
        {
            $nutenti = query("SELECT *,COUNT(*) AS NUTENTI FROM UTENTE WHERE USERNAME='$username';");
            if($nutenti[0]["NUTENTI"] == 0){
                return 0;
            }
            else 
                return $nutenti;
        }
    
/** Funzione che conilada la coppia username e password
@return TRUE se la coppia username e password è corretta **/
        function convalidaUser($username , $password , $TABLE_USER)
        {
            $sale = "" . $TABLE_USER[0]["Salt"];
            $passwordClient = md5("" .$password . $sale);
            if($passwordClient == $TABLE_USER[0]["Password"])
                return True;
            return False;
        }

?>
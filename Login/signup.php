<!DOCTYPE html>
<html lang="en">
<head>
	<title>Sign up</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
    <?php
        require 'componenti-signup.php';
        require 'accesso.php';
    ?>
    
    <?php
            // VERIFICA SE LA PAGINA DI LOGIN E' STATA RICHIESTA DA UNA FORM POST
        function isRequestedFromForm()
        {
            if ($_SERVER['REQUEST_METHOD'] != 'POST') 
                return False;
            return True;
        }
        
        // VERIFICA SE LA PAGINA E' STATA RICHIESTA CORRETTAMENTE
        function isCorrectlyRequested()
        {    
            if((!isset($_POST["nome"])    || 
               !isset($_POST["cognome"]) || 
               !isset($_POST["sesso"]) || 
               !isset($_POST["email"]) || 
               !isset($_POST["username"]) ||
               !isset($_POST["password"])) || 
               ($_POST["nome"]==""    || 
               $_POST["cognome"]=="" || 
               $_POST["sesso"]=="" || 
               $_POST["email"]=="" || 
               $_POST["username"]=="" ||
               $_POST["password"]=="")
               )
                return False;
            return True;
        }
    
        function isNotCorrectEmail(){
            
            $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL); 
            
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
                return False;
            return True;
        }
    
        function isNotCorrectPassword(){
                        
            if(!(preg_match('/[a-z]/',  $_POST["password"]) ==1 &&
                 preg_match('/[A-Z]/',  $_POST["password"]) ==1 &&
                 preg_match('/[1-9]/',  $_POST["password"]) ==1 )&&
                 strlen ($_POST["password"] >= 8))
                return False;
            return True;
        }
    
        // FUNZIONE CHE VIENE CHIAMATA OGNI VOLTA CHE VIENE CARICATA LA PAGINA
        // @RETURN:
        // 0 SE E' STATA CHIAMATA DA FORM NON CORRETTAMENTE
        // 1 SE E' STATA CHIAMATA CORRETTAMENTE DA FORM 
        // -1 SE NON E' STATA CHIAMATA DA FORM
    
        function loadPage(){
            
            if(!isRequestedFromForm())
                return -1;
            
            if(!isCorrectlyRequested() || !isNotCorrectPassword())
                return 0;
            
            if(!isNotCorrectEmail())
                return 2;
            
            return 1;
        }

            
    
    $colorPsw ;
    $colorEmail;
    $usernameNonPresente;
    $esito = loadPage();
    
    if ($esito == 0)
        $colorPsw = "color:red;";
    else if($esito == 2)
        $colorEmail =  "color:red;"; 
    else if ($esito==1)
    {
        if(!createNewUser($_POST))
           $usernameNonPresente = "<p style='font-size:10px;color:red;margin-bottom:30px;'>username gia presente </p>";
        else
            header("location: Login.php");
            
    }
    
    ?>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action ="" onsubmit="return validateFields()" method="post">

					<span class="login100-form-title p-b-48">
                        <img src="../img/logo.png"/>
					</span>
                    
                    <div class="wrap-input100 validate-input">
                        <?php
                             inputTextPersonalizzato("nome");
                        ?>
						<span class="focus-input100" data-placeholder="nome" required></span>
					</div>
                    
                    <div class="wrap-input100 validate-input">
                        <?php
                             inputTextPersonalizzato("cognome");
                        ?>
                          
						<span class="focus-input100" data-placeholder="cognome" required></span>
					</div>
                    
                    <div class="container ">
                        <span class="choose">Sesso</span>

                        <div class="dropdown ">
                            <div class="select">
                                <span>Sesso</span>
                                <i class="fa fa-chevron-left"></i>
                            </div>
                            <input type="hidden" name="sesso" minlength="1" id="input-sesso"  required>
                            <ul class="dropdown-menu">
                                <li id="Maschio">Maschio</li>
                                <li id="Femmina">Femmina</li>
                            </ul>
                        </div>

                    </div>
                    
                    
					<div class="wrap-input100 validate-input " data-validate = "Valid email is: a@b.c" required>
                        <?php
                            inputTextPersonalizzato("email");
                        ?>
						<span class="focus-input100 " data-placeholder="Email"></span>

					</div>
                    
                    <?php
                        if(isset($colorEmail))
                            echo "<p style='font-size:10px;margin-bottom:37px;" .$colorEmail."' >email non valida</p>";
                    ?>
                    
                    <div class="wrap-input100 validate-input">
                        <?php
                            inputTextPersonalizzato("username");
                        ?>
						
						<span class="focus-input100" data-placeholder="username"></span>
					</div>
                    
                    <?php
                        if(isset($usernameNonPresente))
                            echo $usernameNonPresente ;
                    ?>

					<div class="wrap-input100 validate-input" data-validate="Enter password" required style="margin-bottom:10px;">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
                        <?php inputTextPersonalizzato("password"); ?>
						
						<span class="focus-input100" data-placeholder="Password" required></span>
                        
					</div>
                    
                    <?php 
                        // SE E' UNA PASSWORD NON VALIDA CAMBIO COLORE
                        if(isset($colorPsw))
                            echo "<p style='font-size:10px;" .$colorPsw."' id='password-errata'>deve contenere almeno un carattere maiuscolo minuscolo ed uno numerico</p>";
                        else
                            echo "<p style='font-size:10px;' id='password-errata'>deve contenere almeno un carattere maiuscolo minuscolo ed uno numerico</p>";
                    ?>
                    
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type="submit" class="login100-form-btn">
								    Registrati
                            </button>
						</div>
					</div>

					<div class="text-center p-t-115">
						<span class="txt1">
							Hai già un account
						</span>

						<a class="txt2" href="login.php">
							Accedi
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
    <script src="js/validate.js"></script>
    

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
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
            if((!isset($_POST["username"]) ||
                !isset($_POST["password"])) || 
               ($_POST["username"]=="" ||
               $_POST["password"]=="")
               )
                return False;
            return True;
        }
    
        // FUNZIONE CHE VIENE CHIAMATA OGNI VOLTA CHE VIENE CARICATA LA PAGINA
        // @RETURN:
        // 0 SE E' STATA CHIAMATA DA FORM NON CORRETTAMENTE
        // 1 SE E' STATA CHIAMATA CORRETTAMENTE DA FORM 
        // -1 SE NON E' STATA CHIAMATA DA FORM
        function loadPage()
        {
            if(!isRequestedFromForm())
                return -1;
            
            if(!isCorrectlyRequested())
                return 0;
            return 1;
        }
    
        $esito = loadPage();
        $colorLogin;

        if($esito == 0)
            $colorLogin = "color:red;";
        else if($esito==1)
        {
            if(iniziaRicercaUserPsw($_POST["username"] , $_POST["password"]))
            {
                if(isset($_SESSION))
                    session_destroy();
                // ENTRO NELLA PIATTAFORMA
                session_start();
                $_SESSION["username"] = $_POST["username"];
                header("location: ../Piattaforma/Start.php");
            }else
                $colorLogin = "color:red;";
        }
    ?>
    
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="" method="post">

					<span class="login100-form-title p-b-48">
                        <img src="../img/logo.png"/>
					</span>

                    
                    <div class="wrap-input100 validate-input" data-validate="Enter password">
                        <?php inputTextPersonalizzato("username") ?>
						<span class="focus-input100"  data-placeholder="username"></span>
					</div>
                    
                    <div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<?php inputTextPersonalizzato("password") ?>
						<span class="focus-input100" data-placeholder="password"></span>
					</div>
                    
                    <?php
                        if(isset($colorLogin))
                            echo "<p style='font-size:10px;" .$colorLogin."' >Username o Password non validi</p>";
                    ?>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" type="submit">
								Accedi
							</button>
						</div>
					</div>
                    


					<div class="text-center p-t-115">
						<span class="txt1">
							Ancora non hai un account? Corri subito a fartelo
						</span>

						<a class="txt2" href="signup.php">
							Iscriviti
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

</body>
</html>
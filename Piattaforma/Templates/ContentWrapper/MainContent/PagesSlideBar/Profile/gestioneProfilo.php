<?php
/** SCRIPT DI INCLUSIONE DEI DOCUMENTI **/
	require_once("../../../../../Includes/utility.php");
require_once("../../../../../Includes/functions.php");
?>
<?php
session_start();
isStillValid();
$link = mysqli_connect(SERVER, USERNAME,PASSWORD, DATABASE);
?>
<?php
function cercaProfilo($username)
{
$nutenti = query("SELECT *,COUNT(*) AS NUTENTI FROM UTENTE WHERE USERNAME='$username';");
if($nutenti[0]["NUTENTI"] == 0){
return 0;
}
else
return $nutenti;
}

function controllaPassword($username, $password)
{
$TABLE_utentiTrovati = cercaProfilo($username);
if ($TABLE_utentiTrovati == 0)
{
return False;
}
	
	else
{
if(convalidaPass($password, $TABLE_utentiTrovati))
return True;
return False;
}
}

function convalidaPass($password, $TABLE_USER)
{
$sale = "" . $TABLE_USER[0]["Salt"];
$passwordClient = md5("" .$password . $sale);
if($passwordClient == $TABLE_USER[0]["Password"])
return True;
return False;
}

function isNotCorrectPassword()
{
if(!(preg_match('/[a-z]/',  $_POST["nPass"]) ==1 &&
preg_match('/[A-Z]/',  $_POST["nPass"]) ==1 &&
preg_match('/[1-9]/',  $_POST["nPass"]) ==1 )&&
strlen ($_POST["nPass"] >= 8))
return False;
return True;
}


//SE CLICCATO IL BOTTONE PER L'USERNAME
if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['bottoneUser']))
{
	if(cercaUser($_POST['nUser']) != 0)
	{
		echo "Utente già esistente, scegliere un altro username";
	}
	
	else
				{
		if(strlen($_POST['nUser']) > 0)
		{
			echo "Username nuovo = " .$_POST['nUser'];
			$username = $_SESSION['username'];
			$nuovouser = $_POST['nUser'];
			query("UPDATE utente SET Username = '$nuovouser' WHERE Username = '$username'");
			$_SESSION['username'] = $nuovouser;
			header("Refresh:0; url=start.php");
		}
		else
		{
			echo "Impossibile inserire un username vuoto";
		}
	}
}

//SE CLICCATO IL BOTTONE DELLA PASSWORD
else if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['bottonePass']))
{
	if(strlen($_POST['nPass']) == 0)
echo "<script type='text/javascript'>alert('La password non può essere vuota');</script>";
else if($_POST['nPass'] != $_POST['nPassc'])
echo "<script type='text/javascript'>alert('Le password non corrispondono');</script>";
else if(!isNotCorrectPassword())
echo "<script type='text/javascript'>alert('Formato non corretto, inserisci una password con almeno una lettera maiuscola, una lettera minuscola e un numero, e di almeno 8 caratteri');</script>";
else if(controllaPassword($_SESSION['username'], $_POST['vPass']))
{
echo "<script type='text/javascript'>alert('Password cambiata');</script>";
$sale     = mt_rand(0,9999999);
$password = md5($_POST['nPass']. "" .$sale);

query("UPDATE utente SET Password = '$password', Salt = '$sale', WHERE Username = '$username'");
}

else if (!controllaPassword($_SESSION['username'], $_POST['vPass']))
echo "<script type='text/javascript'>alert('Password errata');</script>";
}
?>

<div class="container-login10012">
	<form class="login100-form12 validate-form12" action="" method="post">
		<h1 style="margin-bottom: 30px;text-align:center;"> Gestione account </h1>
		<div>
			<div class="wrap-input10012 validate-input12" data-validate="Enter Username">
				<input class='input10012  has-val12'  minlength='1' type='text' name='nUser'>
				<span class="focus-input10012"  data-placeholder="username"></span>
			</div>
			<div class="container-login100-form-btn12">
				<div class="wrap-login100-form-btn12">
					<div class="login100-form-bgbtn12"></div>
					<button class="login100-form-btn12" type="submit" name = "bottoneUser">
					CONFERMA
					</button>
				</div>
			</div>
		</div>
		<br><br><br>

		<div class="wrap-input10012 validate-input12" data-validate="Enter password">
			<input class='input10012  has-val12'  minlength='1' type = "password" name = "vPass">
			<span class="focus-input10012" data-placeholder=" Inserisci la tua password attuale:"></span>
		</div>
		
		
		<div class="wrap-input10012 validate-input12" data-validate="Enter password">
			
			<input class='input10012 has-val12'  minlength='1' type = "password" name = "nPass">
			<span class="focus-input10012" data-placeholder="  Inserisci la nuova password:"></span>
		</div>
		
		
		<div class="wrap-input10012 validate-input12" data-validate="Enter password">
			<input class='input10012  has-val12'  minlength='1' type = "password" name = "nPassc">
			<span class="focus-input10012" data-placeholder=" Conferma password:"></span>
		</div>
		
		
		<div class="container-login100-form-btn12">
			<div class="wrap-login100-form-btn12">
				<div class="login100-form-bgbtn12"></div>
				<button class="login100-form-btn12" type="submit" name = "bottonePass">
				CONFERMA
				</button>
			</div>
		</div>
	</form>
</div>
<?php
require_once('util.php');
head('Registrer');

//Needs to set redirect, if it isn't already
if(!isset($_GET['redirect'])){
	        $_GET['redirect'] = '/Alumne/index.php';
}

//Checks if loginBackend has noticed any errors, if it has, it gives a fitting errormessage
if(isset($_GET['error'])){
	switch($_GET['error']){

		case 1:
			echo '<span style="color:red;">Alle felter skal udfyldes.</span><br /><br />';
			break;

		case 2:
			echo '<span style="color:red;">De to passwords er ikker ens.</span><br /><br />';
			break;

		case 3:
			echo '<span style="color:red;">Der findes allerede en bruger med denne e-mail.</span><br /><br />';

		default:
			echo '<span style="color:red;">Ukendt fejl.</span><br /><br />';
			break;
	}
}

?>
<h1>Registrer ny bruger</h1>
<form method="post" action="registerBackend.php?redirect=<?php echo $_GET['redirect']?>">
	E-mail (dette vil blive dit brugernavn): <br />
	<input maxlength="30" type="text" name="email" /><br /><br />
	Password: <br />
	<input type="password" name="password1" /><br /><br />
	Gentag password: <br />
	<input type="password" name="password2" /><br /><br />
	Fornavn: <br />
	<input maxlength="30" type="text" name="firstname" /><br /><br />
	Efternavn: <br />
	<input maxlength="30" type="text" name="lastname" /><br /><br />
	<input type="submit" value="Registrer" name="register" />
</form>
<?php
foot();
?>

<?php
require_once('util.php');
head();
	
if(!isset($_GET['redirect']) || $_GET['redirect'] == '/Alumne/login.php' || $_GET['redirect'] == 'login.php'){
        $_GET['redirect'] = '/Alumne/index.php';
}
	
//Checks if loginBackend has noticed any errors, if it has, it gives a fitting errormessage
if(isset($_GET['error'])){
	switch($_GET['error']){
	
		case 1:
			echo "<span style='color:red;'>Manglende e-mail eller adgangskode.</span><br /><br />";
			break;
		
		case 2:
			echo "<span style='color:red;'>Forkert e-mail eller adgangskode.</span><br /><br />";
			break;
			
		case 3:
			echo '<span style="color:red;">Du skal v&aelig;re logget ind for at udf&oslash;rer denne handling!</span><br /><br />';
			break;

		case 4:
			echo '<span style="color:red;">Bruger er oprettet</span><br /><br />';
			break;
				
		default:
			echo "<span style='color:red;'>Ukendt fejl.</span><br /><br />";
			break;
	}
}	

?>

<!-- Loginform -->	
<form action="loginBackend.php?redirect=<?php echo $_GET['redirect']?>" method="post">
	E-mail:<br />
	<input type="text" name="email" />
	<br />

	Adgangskode:<br />
	<input type="password" name="password" />
	<br />

	<input type="submit" value="Login" />
</form>

Ingen bruger endnu? <a href="register.php?redirect=<?php echo $_GET['redirect']?>">Registrer dig her!</a>

<?php
foot();
?>

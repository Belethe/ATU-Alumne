<?php
require_once('util.php');
head();
if(isset($_GET['error'])){
	echo '<span style="color:red;">';
        switch($_GET['error']){

                case 1:
                        echo 'Udfyld venligst alle felter.';
                        break;
		
		case 2:
			echo 'Der findes allerede et arrangement med det navn!';
			break;

                default:
                        echo 'Ukendt fejl';
                        break;
        }
	echo '</span><br /><br />';
}

?>
<h1>Opret et nyt arrangement</h1>
<form action="newEventBackend.php" method="post">
	Titel:<br />
	<input type="text" name="title" /><br />
	Dato:<br />
	<input type="text" name="date" />(Skal skrives åååå-mm-dd)<br />
	Tidspunkt:<br />
	<input type="text" name="time" />(skrives 00:00)<br />
	Sted:<br />
	<input type="text" name="place" /><br />
	Max antal deltagere:<br />
	<input type="text" name="quantity" />(Udfyldes kun, hvis der er en begrænsning!)<br />
	Beskrivelse:<br />
	<textarea rows="5" cols="20" wrap="physical" name="description">	
	</textarea><br />
	<input type="submit" value="Opret" />
</form>
<?php
foot();
?>

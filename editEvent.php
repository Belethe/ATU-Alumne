<?php
require_once('util.php');
require_once('connect.php');
head();

if (!$_GET['id']){
	header('Location: events.php?wtf=0');
	exit;
}

$find = 'SELECT * FROM `event` WHERE `id` = "'.$_GET['id'].'";';
$result = mysql_query($find) or die(mysql_error());
$row=mysql_fetch_array($result);

if(!loginId() == $row['organizer'] || !loginAdmin()){
	header('Location: showEvent.php?id='.$_GET['id']);
	exit;
}

if(isset($_GET['error'])){
	echo '<span style="color:red;">';
	switch($_GET['error']){
		case 1:
			echo 'Udfyld venligst alle felter.';
			break;
			
		case 2:
			echo 'Der findes allerede et arrangement med det navn!';
			break;

		case 3:
			echo 'Arrang&oslash;ren kunne ikke findes.';
			break;

		default:
		    echo 'Ukendt fejl';
		    break;
	}
	echo '</span><br /><br />';
}

$findUsers = 'SELECT `id`, `firstname`, `lastname` FROM `user` ORDER BY `firstname`;';
$UserResult = mysql_query($findUsers) or die(mysql_error());

?>
<h1>Rediger arrangementet</h1>
<form action="editEventBackend.php" method="post">
    Titel:<br />
	<input type="text" name="title" value="<?php echo $row['title'] ?>" /><br />
	Dato:<br />
	<input type="text" name="date" value="<?php echo $row['date'] ?>" />(Skal skrives åååå-mm-dd)<br />
	Tidspunkt:<br />
	<input type="text" name="time" value="<?php echo $row['time'] ?>" />(skrives 00:00)<br />
	Sted:<br />
	<input type="text" name="place" value="<?php echo $row['place'] ?>" /><br />
	Max antal deltagere:<br />
	<input type="text" name="quantity" value="<?php echo $row['quantity'] ?>" />(Udfyldes kun, hvis der er en begrænsning!)<br />
	Beskrivelse:<br />
	<textarea rows="5" cols="20" wrap="physical" name="description" ><?php echo $row['description'] ?></textarea><br />
	Arrang&oslash;r:<br />
	<select name="organizer">
	<?php
	while($user = mysql_fetch_array($UserResult)){
	    echo '<option value="'.$user['id'].'" ';
		if($user['id']==$row['organizer']){
			echo 'selected="selected"'; //xhtml won't allow attributes without a value...
		}
		echo '>'.$user['firstname'].' '.$user['lastname'].'</option>';
	}?>
	<input type="hidden" name="id" value="<?php echo $_GET['id'] ?>" />
	</select><br />
	<input type="submit" value="Opdater" />
</form>
<?php

foot();
?>

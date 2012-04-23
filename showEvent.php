<?php
require_once('util.php');
require_once('connect.php');
head();

if (!$_GET['id']){
	header('Location: events.php');
	break;
}

//Check User's status at this event
$checkEmail = 'SELECT * FROM `subscribe` WHERE `userId`="'.loginId().'" AND `eventId`="'.$_GET['id'].'";';
$check = mysql_query($checkEmail) or die(mysql_error());
$row=mysql_fetch_array($check);
if(!mysql_num_rows($check)){ //If User has not already subscribed
	$status = 'new';
}else{
	$status = $row['status'];
}
//echo $status;

if (isset($_POST['status'])){
	if (loginId()){ //Subscribe funktion here... End with Location: showEvent.php?id=$_GET['id']
		if ($_POST['status'] == 'new' && $status == 'new'){
			$subscribe = mysql_query('INSERT INTO `subscribe` (userId, eventId, status) 
				VALUES ("'.loginId().'", "'.$_GET['id'].'", "subscribe")') or die(mysql_error());
			$message = 1;
		}else if ($_POST['status'] == 'unsubscribe' && $status == 'unsubscribe'){
			$subscribe = mysql_query('UPDATE `subscribe` SET `status` = "subscribe" 
				WHERE `userId`="'.loginId().'" AND `eventId`="'.$_GET['id'].'";') or die(mysql_error());
            $message = 1;
		}else if ($_POST['status'] == 'subscribe' && $status == 'subscribe'){
			$subscribe = mysql_query('UPDATE `subscribe` SET `status` = "unsubscribe" 
				WHERE `userId`="'.loginId().'" AND `eventId`="'.$_GET['id'].'";') or die(mysql_error());
            $message = 2;
		}
		header('Location: showEvent.php?id='.$_GET['id'].'&message='.$message);
		break;

	}else{ //If User is not logged in, go to login page
		header('Location: login.php?error=3&redirect='.$_SERVER['PHP_SELF'].'?id='.$_GET['id']);
	}
}

if(isset($_GET['message'])){
	echo '<span style="color:red;">';
	switch($_GET['message']){

		case 1:
	    	echo 'Du er tilmeldt';
	    	break;

		case 2:
			echo 'Du er meldt fra';
			break;

		case 3:
			echo 'Arrangement er blevet opdateret';
			break;

        default:
			echo 'Noget gik galt';
			break;
	}
	echo '</span>';
}

$find = 'SELECT * FROM `event` WHERE `id` = "'.$_GET['id'].'";';
$result = mysql_query($find) or die(mysql_error());
$row=mysql_fetch_array($result);

$findOrganizer = 'SELECT `firstname`, `lastname` FROM `user` WHERE `id`='.$row['organizer'].' ORDER BY `firstname`;';
$organizerResult = mysql_query($findOrganizer) or die(mysql_error());
$organizer = mysql_fetch_array($organizerResult);

echo '<h1>'.$row['title'].'</h1>';
echo '<i>Arrang&oslash;r: '.$organizer['firstname'].' '.$organizer['lastname'].'</i><br />';
echo $row['place'].'<br />';
echo $row['date'].' '.$row['time'].'<br />';
echo 'Beskrivelse: '.$row['description'].'<br />';

?>
<form action="showEvent.php?id=<?php echo $_GET['id']; ?>" method="POST">
	<input type="hidden" name="status" value="<?php echo $status; ?>"/>
	<input type="submit" value="<?php if ($status == 'unsubscribe' || $status == 'new') {echo 'Tilmeld';}else{echo 'Meld fra';} ?>" />
</form>
<?php

if(loginId() == $row['organizer'] || loginAdmin()){
	?>
	<form action="editEvent.php" method="GET">
		<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
		<input type="submit" value="Rediger event" />
	</form>
	<?php
}


//Files
echo'<h3>Dokumenter</h3>';

$findFiles = 'SELECT * FROM `file` WHERE `eventId` = "'.$_GET['id'].'";';
$files = mysql_query($findFiles) or die(mysql_error());

if (!mysql_num_rows($files)){
	echo '<i>Der findes ikke nogle filer knyttet til dette arrangement</i>';
}else{
	echo '<ul>';
	while($file=mysql_fetch_array($files)){
		echo '<li><a href="upload/'.$file['eventId'].'_'.$file['title'].'">'.$file['title'].'</a>('.($file['size']/1024).' kb)</li>';
	}
	echo '</ul>';
}

foot();
?>

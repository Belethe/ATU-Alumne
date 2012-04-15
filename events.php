<?php
require_once('util.php');
require_once('connect.php');

head('Arrangementer');
echo"<h1>Arrangementer</h1>";

if(isset($_GET['error'])){
	echo '<span style="color:red;">';
	switch($_GET['error']){

		case 1:
			echo 'Arrangementet '.$_GET['title'].' er oprettet.';
			break;

		default:
			echo 'Ukendt fejl';
			break;
	}
	echo '</span><br /><br />';
}

/*if(isset($_POST['eventId'])){ //Move to showEvent.php
	$checkEmail = 'SELECT * FROM `subscribe` WHERE `userId`="'.loginId().'" AND `eventId`="'.$_POST['eventId'].'";';
	$check = mysql_query($checkEmail) or die(mysql_error());
	if (mysql_num_rows($check)>0){
		if($check['status']=='unsubscribe'){
			$status = 'subscribe';
		}else{
			$status = 'unsubscribe';
		}
		$updateStatus = 'UPDATE `subscribe` SET status="'.$status.'" WHERE `userId`="'.loginId().'" AND `eventId`="'.$_POST['eventId'].'";';
		mysql_query($updateStatus) or die(mysql_error());
		header('Location: events.php');
		exit;
	}else{
		$subscribe = 'INSERT INTO `subscribe` (userId, eventId, status) VALUES ("'.mysql_real_escape_string(loginId()).'", "'.mysql_real_escape_string($_POST['eventId']).'", "subscribe");';
		mysql_query($subscribe) or die(mysql_error());
		header('Location: events.php');
		exit;
	}
}*/

$findEvents = "SELECT * FROM `event` ORDER BY `date`;";
$result = mysql_query($findEvents) or die(mysql_error());

echo"<br />";
echo"<table>";
	echo '<tr>
		<td><b>Dato:</b></td>
		<td><b>Titel:</b></td>
		<td><b>Time:</b></td>
		<td><b>Place:</b></td>';
	/*if(loginId()){ //move to showEvent.php
		echo'<td><b>Tilmeld:</b></td>';
	}*/
	echo'</tr>';
	while($row=mysql_fetch_array($result)){
		echo '<tr>
			<td>'.$row["date"].'</td>
			<td><a href="showEvent?id='.$row["id"].'">'.$row["title"].'</a></td>
			<td>'.$row["time"].'</td>
			<td>'.$row["place"].'</td>';
		/*if(loginId()){ //move to ShowEvent.php
			?>
			<td>
			<form action="events.php" method="post">
				<input type="hidden" name="eventId" value="<?php echo $row['id'] ?>"/>
				<input type="submit" value="Tilmeld (indtil det flyttes)" />
			</form>
			</td>
			<?php
		}*/
		echo '</tr>';
	}
echo '</table>';

if(loginAdmin()){
	?>
	<a href="newEvent.php">Opret nyt arrangement?</a>
	<?php
}

foot();
?>

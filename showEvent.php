<?php
require_once('util.php');
require_once('connect.php');
head();

if (!$_GET['id']){
	header('Location: events.php');
	break;
}

if ($_GET['subscribe'] == 'sub'){
	echo'sub'; //Subscribe funktion here... End with Location: showEvent.php?id=$_GET['id']
}

$find = 'SELECT * FROM `event` WHERE `id` = "'.$_GET['id'].'";';
$result = mysql_query($find) or die(mysql_error());
$row=mysql_fetch_array($result);

echo '<h1>'.$row['title'].'</h1>';
echo '<i>'.$row['place'].'</i><br />';
echo $row['date'].' '.$row['time'].'<br />';
echo 'Beskrivelse: '.$row['description'].'<br />';

?>
<form action="showEvent.php" method="GET">
	<input type="hidden" name="id" value="<?php echo $_GET['id']?>"/>
	<input type="hidden" name="subscribe" value="sub"/>
	<input type="submit" value="Tilmeld" />
</form>
<?php
foot();
?>

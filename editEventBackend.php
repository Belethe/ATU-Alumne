<?php
require_once('util.php');
require_once('connect.php');
head();

if(!$_POST['title'] || !$_POST['date'] || !$_POST['time'] || !$_POST['place'] || !$_POST['description'] || !$_POST['organizer'] || !$_POST['id']){
	header('Location: editEvent.php?=1'); //Empty fields
	exit;
}

$title = mysql_real_escape_string($_POST['title']);
$date = mysql_real_escape_string($_POST['date']);
$time = mysql_real_escape_string($_POST['time']);
$place = mysql_real_escape_string($_POST['place']);
$quantity = mysql_real_escape_string($_POST['quantity']);
$description = mysql_real_escape_string($_POST['description']);
$organizer = mysql_real_escape_string($_POST['organizer']);
$id = mysql_real_escape_string($_POST['id']);

$checkTitle = 'SELECT * FROM `event` WHERE `title`="'.$title.'" AND `id`!="'.$id.'";';
$check = mysql_query($checkTitle) or die(mysql_error());
if (mysql_num_rows($check)>0){
	header('Location: editEvent.php?error=2'); //Another event is already using that title
	exit;
}

$checkOrganizer = 'SELECT * FROM `user` WHERE `id`="'.$organizer.'";';
$check = mysql_query($checkOrganizer) or die(mysql_error());
if (!mysql_num_rows($check)){
	header('Location: editEvent.php?error=3'); //Invalid organizer-id
	exit;
}

$updateEvent  = 'UPDATE `event` SET title="'.$title.'", date="'.$date.'", time="'.$time.'", place="'.$place.'", description="'.$description.'", organizer="'.$organizer.'"';
if($quantity){
	$updateEvent .= ', quantity="'.$quantity.'"';
}
$updateEvent .= ' WHERE `id`="'.$id.'";';

if(mysql_query($updateEvent)){
	header('Location: showEvent.php?id='.$id.'&message=3');
	exit;
}

foot();
?>

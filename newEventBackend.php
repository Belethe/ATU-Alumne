<?php
require_once('util.php');
require_once('connect.php');
head();
/*echo $_POST['title'].' '.$_POST['date'].' '.$_POST['time'].' '.$_POST['place'].' '.$_POST['quantity'].' '.$_POST['description'].' '.$_POST['organizer'];*/
if(!$_POST['title'] || !$_POST['date'] || !$_POST['time'] || !$_POST['place'] || !$_POST['description']){
	header('Location: newEvent.php?error=1');
	exit;
}

$title = mysql_real_escape_string($_POST['title']);
$date = mysql_real_escape_string($_POST['date']);
$time = mysql_real_escape_string($_POST['time']);
$place = mysql_real_escape_string($_POST['place']);
$quantity = mysql_real_escape_string($_POST['quantity']);
$description = mysql_real_escape_string($_POST['description']);
$organizer = mysql_real_escape_string(loginId()); //Should I escape this, or is there no reason?

$checkTitle = 'SELECT * FROM `event` WHERE `title`="'.$title.'";';

$check = mysql_query($checkTitle) or die(mysql_error());
if (mysql_num_rows($check)>0){
        header('Location: newEvent.php?error=2'); //another event is already using that title
        exit;
}

$newEvent  = 'INSERT INTO `event` SET title="'.$title.'", date="'.$date.'", time="'.$time.'", place="'.$place.'", description="'.$description.'", organizer="'.$organizer.'"';
if($quantity){
	$newEvent .= ', quantity="'.$quantity.'";';
}else{
	$newEvent .= ';';
}

if(mysql_query($newEvent)){
        header('Location: events.php?error=1&title='.$title);
        exit;
}else{
	echo $newEvent;
}

foot();
?>

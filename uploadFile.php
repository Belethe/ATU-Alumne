<?php
require_once('util.php');
require_once('connect.php');
head();

$allowedTypes = array(
	'zip' => 'application/zip',
	'pdf' => 'application/pdf',
	'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
	'odt' => 'application/vnd.oasis.opendocument.text',
	'txt' => 'text/plain'
);

//echo 'Uploade File';

if(!in_array($_FILES['file']['type'],$allowedTypes)){
	header('Location: editEvent.php?id='.$_POST['id'].'&error=4');
}

if ($_FILES["file"]["error"] > 0){
	echo "Error: " . $_FILES["file"]["error"] . "<br />";
}else{
	
	/*echo "Upload: " . $_FILES["file"]["name"] . "<br />";
	echo "Type: " . $_FILES["file"]["type"] . "<br />";
	echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
	echo "Stored in: " . $_FILES["file"]["tmp_name"].'<br />';
	echo 'Event id: '.$_POST['id'];*/

	$eventId = mysql_real_escape_string($_POST["id"]);
	$title = mysql_real_escape_string($_FILES["file"]["name"]);
	$type = mysql_real_escape_string($_FILES["file"]["type"]);
    $size = mysql_real_escape_string($_FILES["file"]["size"]);

	move_uploaded_file($_FILES['file']['tmp_name'], 'upload/'.$eventId.'_'.$title);
	
	$uploadQuery = 'INSERT INTO `file` (eventId, uploaderId, title, type, size) VALUE ("'.$eventId.'", "'.loginId().'", "'.$title.'", "'.$type.'", "'.$size.'");';
	$upload = mysql_query($uploadQuery);
	header('Location: editEvent.php?id='.$_POST['id'].'&error=5');
	
}

//echo 'Fil uploadet';

foot();
?>

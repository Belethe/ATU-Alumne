<?php
require_once('connect.php'); //To make sure that connect.php is only required once
require_once('util.php'); //To make sure that util.php is only required once
head();

if(!isset($_GET['redirect'])){
	$_GET['redirect'] = '/Alumne/index.php';
}

//Check that everything is set:
if(!$_POST['email'] || !$_POST['password']) {
	header('Location: login.php?error=1&redirect='.$_GET['redirect']);
	login(0); //sets userId to 0, which means logged off
	exit;
}

//Arrays of which chars that should be replaced with what
$search = array('<', '>');
$replace = array('&lt;', '&gt;');

$checkLogin = "SELECT * FROM `user` WHERE `email`='".mysql_real_escape_string(str_replace($search, $replace, $_POST['email']))."' AND `password`='".hash('sha256',$_POST['password'])."';";
$result = mysql_query($checkLogin) or die(mysql_error());
if(mysql_num_rows($result) < 1) {
	header('Location: login.php?error=2&redirect='.$_GET['redirect']);
	login(0); //sets userId to 0, which means logged off
	exit;
}
$row = mysql_fetch_array($result); //Henter valgte data fra databasen
login($row['id'], $row['firstname'], $row['lastname']);
	
header('Location: '.$_GET['redirect']);
exit;

foot();
?>

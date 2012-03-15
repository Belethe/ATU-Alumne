<?php

session_start(); //To make sure the session is started on every page

function head($title = 'ATU - Alumne') {
	header('Content-Type: application/xhtml+xml;charset=UTF-8');
	?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="utf-8" />
		<title><?php echo $title ?></title>
	</head>
	<body>
	<a href="index.php"><img src="logo.png" alt="ATU Alumne logo" /></a>
	<br />
	<?php
	menu();
	echo '<br />';
	
}

function menu () {
	if(!loginId()){
		$loginN = 'Log ind';
		$loginP = 'login.php';
	} else {
		$loginN = 'Log ud';
		$loginP = 'logout.php';
	}
	$mainPages = array(	'Forside' => 'index.php',
						'Arrangementer' => 'events.php',
						'Medlemmer' => 'users.php',
						'Om ATU Alumne' => 'about.php',
						'Sponsorer' => 'sponsor.php',
						$loginN => $loginP.'?redirect='.$_SERVER['PHP_SELF']);

	foreach($mainPages as $name => $page){
		echo '<a href="'.$page.'">'.$name.'</a> ';
	}
}

function foot() {
	?>
	</body>
</html>
	<?php
}

function login($id, $fname = "naN", $lname = "naN") {
	$_SESSION['LoggedIn'] = $id;
	$_SESSION['Name'] = $fname." ".$lname;
}

function loginId() {
	if(!isset($_SESSION['LoggedIn'])){
		$_SESSION['LoggedIn'] = 0;
	}
	return $_SESSION['LoggedIn'];
}

function loginName() {
	return $_SESSION['Name'];
}

?>

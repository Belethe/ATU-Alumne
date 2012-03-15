<?php
require_once('util.php');
require_once('connect.php');
head();

/*//Following two lines is for testing purpose only...
echo'backend ';
echo $_POST['email'].' '.$_POST['password1'].' '.$_POST['password2'].' '.$_POST['firstname'].' '.$_POST['lastname'];*/

//Check that no fields are empty
if(!$_POST['email'] || !$_POST['password1'] || !$_POST['password2'] || !$_POST['firstname'] || !$_POST['lastname']){
	header('Location: register.php?error=1');
	exit;
//Check that the two passwords match
}else if($_POST['password1'] != $_POST['password2']){
	header('Location: register.php?error=2'); //Passwords are not alike
	exit;
}

//Arrays of which chars that should be replaced with what
$search = array('<', '>');
$replace = array('&lt;', '&gt;');

// Sanitize input and get the hash-value of the password
$email = mysql_real_escape_string(str_replace($search, $replace, $_POST['email']));
$password = hash('sha256',($_POST['password1']));
$firstname = mysql_real_escape_string(str_replace($search, $replace, $_POST['firstname']));
$lastname = mysql_real_escape_string(str_replace($search, $replace, $_POST['lastname']));

$checkEmail = 'SELECT * FROM `user` WHERE `email`="'.$email.'";';

$check = mysql_query($checkEmail) or die(mysql_error);
if (mysql_num_rows($check)>0){
	header('Location: register.php?error=3');//e-mail is already used
	exit;
}

$newUser = 'INSERT INTO `user` (email,password,firstname,lastname) VALUES ("'.$email.'","'.$password.'","'.$firstname.'","'.$lastname.'");';
if(mysql_query($newUser)){
	header('Location: login.php?error=4');
	exit;
}

foot();
?>

<?php
require_once('util.php');
head();
if(loginId()){
	echo "Hello ".loginName();
} else{
	echo "Hello, You!";
}
foot();
?>

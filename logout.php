<?php
require_once('util.php');

if(!isset($_GET['redirect'])){
        $_GET['redirect'] = '/Alumne/index.php';
}

login(0);
header('Location: '.$_GET['redirect']);
?>

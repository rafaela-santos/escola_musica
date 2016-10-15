<?php
	session_start();
	$_SESSION['login'] = '';
	$_SESSION['nome'] = '';
	unset($_SESSION['login']);
	unset($_SESSION['nome']);

	header('location: /');
?>
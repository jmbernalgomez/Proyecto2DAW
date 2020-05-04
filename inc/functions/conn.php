<?php 

	$host = 'localhost';
	$user = 'root';
	$pass = '';
	$bd = 'youtube';

	$db = mysqli_connect($host,$user,$pass,$bd) or die("No se ha podido conectar a la base de datos");
	mysqli_set_charset($db,"utf8");

	if (!isset($_SESSION)) {
		session_start();
	}
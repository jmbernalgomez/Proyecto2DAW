<?php
	
	require_once '../functions/conn.php';

	if (!isset($_SESSION['user'])) :
		header('Location: ../../index.php');
	else :
		//Recoger los datos
        $nombre = isset($_POST['nombre']) ? filter_var($_POST['nombre'], FILTER_SANITIZE_STRING) : false;
        $apellidos = isset($_POST['apellidos']) ? filter_var($_POST['apellidos'], FILTER_SANITIZE_STRING) : false;
        $email = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_SANITIZE_STRING) : false;
        $pass = isset($_POST['pass']) ? filter_var($_POST['pass'], FILTER_SANITIZE_STRING) : false;
        $id = isset($_GET['id']) ? filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT) : false;

        $secure_pass = password_hash($pass, PASSWORD_BCRYPT);

        $sql = "UPDATE usuarios SET nombre = '".$nombre."', apellidos = '".$apellidos."', email = '".$email."', passwordc = '".$secure_pass."' WHERE id = '".$id."'";
        $query = mysqli_query($db,$sql);
        
        header("Location: ../../perfil.php");

	endif;
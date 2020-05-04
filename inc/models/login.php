<?php

	if (isset($_POST)) {
		require_once '../functions/conn.php';

		//Recoger los datos del formulario
		$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
		$pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);

		//Consulta para saber si existe usuario
		$sql = "SELECT * FROM usuarios WHERE email = '$email'";
		$login = mysqli_query($db,$sql);

		if (($login) && (mysqli_num_rows($login) == 1)){
			$user = mysqli_fetch_assoc($login); //Metemos la variable de login pero en Array

			//Comprobar contraseña
			$verify = password_verify($pass, $user['passwordc']);
			if ($verify) {
				$_SESSION['user'] = $user;
				if (isset($_SESSION['error_login'])) { //Si existe error login lo borramos
					session_destroy();
				}
			}
			else{
				$_SESSION['error_login'] = "Login incorrecto";
			}
		}
		else{
			$_SESSION['error_login'] = "Login incorrecto";
		}
	}

	header('Location:'.$_SERVER[HTTP_REFERER]);
<?php

	if (isset($_POST)) {
		require_once '../functions/conn.php';
		//Recoger los datos
		$nombre = isset($_POST['nombre']) ? filter_var($_POST['nombre'], FILTER_SANITIZE_STRING) : false;
		$apellidos = isset($_POST['apellidos']) ? filter_var($_POST['apellidos'], FILTER_SANITIZE_STRING) : false; //si no existe da false
		$email = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_SANITIZE_STRING) : false; //Para que no se pueda meter HTML 
		$pass = isset($_POST['pass']) ? filter_var($_POST['pass'], FILTER_SANITIZE_STRING) : false;
		$passc = isset($_POST['passc']) ? filter_var($_POST['passc'], FILTER_SANITIZE_STRING) : false;

		//Array de errores
		$errors = array();

		//Validar los valores

		//Nombre
		if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/",$nombre)) {
			$validate_nombre = true;
		}
		else{
			$validate_nombre = false;
			$errors['nombre'] = "El nombre no es válido";
		}

		//Apellidos
		if (!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/",$apellidos)) {
			$validate_apellidos = true;
		}
		else{
			$validate_apellidos = false;
			$errors['apellidos'] = "Los apellidos no son válidos";
		}

		//Email
		if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$validate_email = true;
		}
		else{
			$validate_email = false;
			$errors['email'] = "El email no es válido";
		}

		//Contraseña
		if (!empty($pass)) {
			if ($pass == $passc) {
				$validate_pass = true;
			}
			else{
				$validate_pass = false;
				$errors['passc'] = "Las contraseñas no coinciden";
			}
		}
		else{
			$validate_pass = false;
			$errors['pass'] = "La contraseña no puede estar vacía";
		}
		
		$guardar_usuario = false;

		if (count($errors) == 0) {
			$guardar_usuario = true;
			$secure_pass = password_hash($pass, PASSWORD_BCRYPT); //Contraseña cifrada

			
			

			$sql = "INSERT INTO usuarios VALUES(null,'$nombre','$apellidos', '$email','$secure_pass','portada.jpg', 'usuario.jpg',CURDATE())";
			$query = mysqli_query($db,$sql);
			if ($query) {
				$_SESSION['success'] = "Se ha registrado con éxito";
			}
			else{
				$_SESSION['errors']['general'] = "Fallo al registrarse, puede que el correo ya esté registrado";
			}
		}
		else{
			$_SESSION['errors'] = $errors;
		}		

	}

	header('Location:'.$_SERVER['HTTP_REFERER']); //Me lleva a la última página en la que he estado
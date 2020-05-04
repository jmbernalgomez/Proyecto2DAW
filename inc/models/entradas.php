<?php
	
	require_once '../functions/conn.php';

	if (!isset($_SESSION['user'])) :
		header('Location: ../../index.php');
	else :
		$accion = $_GET['accion'];
		if ($accion == 'crear') {
			//Recoger los datos
			$titulo = isset($_POST['titulo']) ? filter_var($_POST['titulo'], FILTER_SANITIZE_STRING) : false;
			$descripcion = isset($_POST['descripcion']) ? filter_var($_POST['descripcion'], FILTER_SANITIZE_STRING) : false;
			$categoria = isset($_POST['categoria']) ? filter_var($_POST['categoria'], FILTER_SANITIZE_STRING) : false;
			$recomendacion = isset($_POST['recomendacion']) ? filter_var($_POST['recomendacion'], FILTER_SANITIZE_STRING) : false;
			$tags = isset($_POST['tags']) ? filter_var($_POST['tags'], FILTER_SANITIZE_STRING) : false;




			$validate_url = true;
			$tipo_url = $_FILES['url']['type'];
			$nombre_url = filter_var($_FILES['url']['name'], FILTER_SANITIZE_STRING);
			$guardado_url = $_FILES['url']['tmp_name'];
			$tamano_url = $_FILES['url']['size'];
				if ($tamano_url <= 2000000) {
					if ($tipo_url == "video/mp4") {
						if (move_uploaded_file($guardado_url, '../../videos/'.$nombre_url)) {
							// echo "El video se ha guardado correctamente";
						}
					}
				}


			$validate_imagen = true;
			$tipo_imagen = $_FILES['imagen']['type'];
			$nombre_imagen = filter_var($_FILES['imagen']['name'], FILTER_SANITIZE_STRING);
			$guardado_imagen = $_FILES['imagen']['tmp_name'];
			$tamano_imagen = $_FILES['imagen']['size'];
				if ($tamano_imagen <= 2000000) {
					if ($tipo_imagen == "image/jpeg" || $tipo_imagen == "image/jpg" || $tipo_imagen = "image/png") {
						if (move_uploaded_file($guardado_imagen, '../../images/'.$nombre_imagen)) {
							// echo "La imagen se ha guardado correctamente";
						}
					}
				}

					
			if (count($errors) == 0) {
				$guardar_entrada = true;
				$id_usuario = $_SESSION['user']['id'];

				$sql = "INSERT INTO entradas VALUES(null, '$titulo', '$descripcion', '$nombre_url', '$categoria', '$tags' , '$nombre_imagen', CURDATE(), '$recomendacion', '$id_usuario')";
				$query = mysqli_query($db,$sql);
				if ($query) {
					$_SESSION['success'] = "La entrada se ha creado con éxito";
				}
				else{
					$_SESSION['errors']['general'] = "Fallo al guardar la entrada";
				}
			}
			else{
					$_SESSION['errors'] = $errors;
			}


		}

		if ($accion == 'editar') {
				//Recoger los datos
				$titulo = isset($_POST['titulo']) ? filter_var($_POST['titulo'], FILTER_SANITIZE_STRING) : false;
				$descripcion = isset($_POST['descripcion']) ? filter_var($_POST['descripcion'], FILTER_SANITIZE_STRING) : false;
				$categoria = isset($_POST['categoria']) ? filter_var($_POST['categoria'], FILTER_SANITIZE_STRING) : false;
				$recomendacion = isset($_POST['recomendacion']) ? filter_var($_POST['recomendacion'], FILTER_SANITIZE_STRING) : false;
				$tags = isset($_POST['tags']) ? filter_var($_POST['tags'], FILTER_SANITIZE_STRING) : false;
				$id = isset($_GET['id']) ? filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT) : false;

				$errors = array();

				if (!empty($_FILES)) {

					$validate_imagen = true;
					$tipo_imagen = $_FILES['imagen']['type'];
					$nombre_imagen = filter_var($_FILES['imagen']['name'], FILTER_SANITIZE_STRING);
					$imagen_actual = filter_var($_POST['imagen_actual'], FILTER_SANITIZE_STRING); //Si no se cambia la imagen guarda la imagen actual
					$guardado = $_FILES['imagen']['tmp_name'];
					$tamano_imagen = $_FILES['imagen']['size'];
					if ($nombre_imagen != 'no-disponible.png') {
						if ($tamano_imagen <= 2000000) {
							if ($tipo_imagen == "image/jpeg" || $tipo_imagen == "image/jpg" || $tipo_imagen = "image/png") {
								if (move_uploaded_file($guardado, '../../images/'.$nombre_imagen)) {
									// echo "La imagen se ha guardado correctamente";
								}
							}
						}
					}
				}	
				else{
					$validate_imagen = false;
				}
				
				if (count($errors) == 0) {
					$nombre_imagen = !empty($nombre_imagen) ? $nombre_imagen : $imagen_actual;

					$sql = "UPDATE entradas SET titulo = '".$titulo."', descripcion = '".$descripcion."', categoria = '".$categoria."', tags = '".$tags."', imagen = '".$nombre_imagen."',  recomendacion = '".$recomendacion."' WHERE id = '".$id."'";
					$query = mysqli_query($db,$sql);

					if ($query && $imagen_actual != 'no-disponible.png' && $nombre_imagen != $imagen_actual) { //Borrar la imagen anterior a la cambiada
						unlink("../../images/$imagen_actual");
					}
				}



			}
			if ($accion == 'eliminar') {
				$id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
				$imagen = filter_var($_GET['imagen'], FILTER_SANITIZE_STRING); 
				$video = filter_var($_GET['video'], FILTER_SANITIZE_STRING); 
				$id_usuario = $_SESSION['user']['id'];

				$sql = "DELETE FROM entradas WHERE id = $id AND id_usuario = $id_usuario";
				$query = mysqli_query($db,$sql);

				if ($query) {
					unlink("../../images/$imagen");
					unlink("../../videos/$video");
				}
			}
		

		header("Location: ../../entradas.php");

	endif;
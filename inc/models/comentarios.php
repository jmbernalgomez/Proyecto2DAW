<?php 

	require '../functions/conn.php';
	if (!isset($_SESSION['user'])) :
		header('Location: ../../index.php');
	else:
		if ($_GET['accion'] ==  'borrar') {
			$id = $_GET['id_comentario'];

			try {
				$sql = "DELETE FROM comentarios where `comentarios`.`id` = $id";	
				$query = mysqli_query($db,$sql);
			} 
			catch (Exception $e) {
				var_dump($e->getMessage());
			}
		}
		else{
			$mi_id = $_SESSION['user']['id'];
			$id_entrada = $_GET['id_entrada'];
			$comentario = filter_var($_POST['mi'], FILTER_SANITIZE_STRING);

			try {
				$sql = "INSERT INTO comentarios VALUES(null,'$comentario', '$id_entrada', '$mi_id')";	
				$query = mysqli_query($db,$sql);	
			} 
			catch (Exception $e) {
				var_dump($e->getMessage());
			}
		}

		 header('Location:'.$_SERVER['HTTP_REFERER']);

	endif;



 ?>
<?php 

	require '../functions/conn.php';
	if (!isset($_SESSION['user'])) :
		header('Location: ../../index.php');
	else:
		if ($_GET['accion'] ==  'borrar') {
			$id = $_GET['id_respuesta'];

			try {
				$sql = "DELETE FROM respuestas_comentarios where `respuestas_comentarios`.`id` = $id";	
				$query = mysqli_query($db,$sql);
			} 
			catch (Exception $e) {
				var_dump($e->getMessage());
			}
		}
		else{
			$mi_id = $_SESSION['user']['id'];
			$id_comentario = $_GET['id_comentario']; // id comentario al que responde
			$respuesta = filter_var($_POST['respuesta'], FILTER_SANITIZE_STRING);

			try {
				$sql = "INSERT INTO respuestas_comentarios VALUES(null,'$respuesta', '$id_comentario', '$mi_id')";	
				$query = mysqli_query($db,$sql);	
			} 
			catch (Exception $e) {
				var_dump($e->getMessage());
			}
		}

		 header('Location:'.$_SERVER['HTTP_REFERER']);

	endif;



 ?>
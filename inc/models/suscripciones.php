<?php 
	
	require '../functions/conn.php';

	if (!isset($_SESSION['user'])) :
		header("Location:  ../index.php");

	else:
		$id_usuario = $_SESSION['user']['id'];
		$id_suscrito = $_GET['id_usuario'];
		$id_suscripcion = $_GET['id_suscripcion'];
		$id_primario = $id_usuario.$id_suscrito;

		try {
			$sql = "INSERT INTO suscripciones VALUES($id_primario, $id_suscrito, $id_usuario)";	
			$query = mysqli_query($db,$sql);
		} 
		catch (Exception $e) {
			var_dump($e->getMessage());
		}

		if (isset($id_suscripcion)) {
			try {
				$sql = "DELETE FROM suscripciones WHERE id = $id_primario";	
				$query = mysqli_query($db,$sql);
			} 
			catch (Exception $e) {
				var_dump($e->getMessage());
			}
		}

		if(isset($_GET['busqueda'])){
			header('Location: ../../videos.php?busqueda='.$_GET['busqueda']);
		}
		else{
			header('Location:'.$_SERVER['HTTP_REFERER']);
		}

	endif;

?>
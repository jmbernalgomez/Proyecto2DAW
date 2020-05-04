<?php 

	require '../functions/conn.php';
	if (!isset($_SESSION['user'])) :
		header('Location: ../../index.php');
	else:
		$mi_id = $_SESSION['user']['id'];
		$id = $_GET['id_like'];
		$id_entrada = $_GET['id_entrada'];
		$estado = $_GET['estado'];
		$id_primario = $id_entrada.$mi_id;

		try {
			$sql = "INSERT INTO likes VALUES('$id_primario', '$id_entrada', '$mi_id')";	
			$query = mysqli_query($db,$sql);
		} 
		catch (Exception $e) {
			var_dump($e->getMessage());
		}

		if ($estado ==1) {
			try {
				$sql = "DELETE FROM likes WHERE `likes`.`id` = $id_primario";	
				$query = mysqli_query($db,$sql);
			} 
			catch (Exception $e) {
				var_dump($e->getMessage());
			}
		}

		header('Location:'.$_SERVER['HTTP_REFERER']);

	endif;



 ?>

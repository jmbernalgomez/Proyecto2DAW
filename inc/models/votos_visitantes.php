<?php 
    
    require '../functions/conn.php';
	if (!isset($_SESSION['user'])) :
		header('Location: ../../index.php');
	else:
		$recomendacion = $_POST['recomendacion'];
        $id_entrada = $_GET['id_entrada'];
        $id_usuario = $_GET['id_usuario'];

        $sql1 = "SELECT * FROM recomendaciones_visitantes WHERE id_entrada = $id_entrada AND id_usuario =  $id_usuario";
        $query1 = mysqli_query($db,$sql1);

        echo (mysqli_num_rows($query1));

        if(mysqli_num_rows ($query1) == 0){
            $sql2 = "INSERT INTO recomendaciones_visitantes VALUES(NULL, $id_entrada, $recomendacion, $id_usuario)";	
            $query2 = mysqli_query($db,$sql2);
        }
        else{
            $sql3 = "UPDATE recomendaciones_visitantes
                     SET recomendacion = $recomendacion
                    WHERE id_entrada = $id_entrada AND id_usuario =  $id_usuario";	
            $query3 = mysqli_query($db,$sql3);
        }

        header('Location:'.$_SERVER['HTTP_REFERER']);

	endif;


?>
<?php 

	require '../functions/conn.php';
	if (!isset($_SESSION['user'])) :
		header('Location: ../../index.php');
    else:

        $id_usuario = $_SESSION['user']['id'];
        
		if ($_GET['accion'] ==  'borrar') {
			try {
				$sql = "UPDATE usuarios SET imagen_portada='portada.jpg' WHERE id = $id_usuario";	
                $query = mysqli_query($db,$sql);
			} 
			catch (Exception $e) {
				var_dump($e->getMessage());
            }
            
		}
		else{

            if ($_GET['accion'] ==  'editar') {
            
                if (!empty($_FILES)) {
                    $validate_imagen = true;
                    $tipo_imagen = $_FILES['imagen']['type'];
                    $nombre_imagen = filter_var($_FILES['imagen']['name'], FILTER_SANITIZE_STRING);
                    $guardado = $_FILES['imagen']['tmp_name'];
                    $tamano_imagen = $_FILES['imagen']['size'];
                        if ($tamano_imagen <= 2000000) {
                            if ($tipo_imagen == "image/jpeg" || $tipo_imagen == "image/jpg" || $tipo_imagen = "image/png") {
                                if (move_uploaded_file($guardado, '../../images/'.$nombre_imagen)) {
                                    // echo "La imagen se ha guardado correctamente";
                                    echo $nombre_imagen;
                                    try {
                                        $sql = "UPDATE usuarios SET imagen_portada= '$nombre_imagen' WHERE id = $id_usuario";	
                                        $query = mysqli_query($db,$sql);	
                                    } 
                                    catch (Exception $e) {
                                        var_dump($e->getMessage());
                                    }
                                }
                            }
                        }
                }	
                else{
                    $validate_imagen = false;
                    header('Location: ../../editar_portada.php');
                }
            }
        }



        if ($_GET['accion'] ==  'borrar1') {
			try {
				$sql = "UPDATE usuarios SET imagen_perfil='usuario.jpg' WHERE id = $id_usuario";	
                $query = mysqli_query($db,$sql);
			} 
			catch (Exception $e) {
				var_dump($e->getMessage());
            }
            
		}
		else{

            if ($_GET['accion'] ==  'editar1') {
            
                if (!empty($_FILES)) {
                    $validate_imagen = true;
                    $tipo_imagen = $_FILES['imagen']['type'];
                    $nombre_imagen = filter_var($_FILES['imagen']['name'], FILTER_SANITIZE_STRING);
                    $guardado = $_FILES['imagen']['tmp_name'];
                    $tamano_imagen = $_FILES['imagen']['size'];
                        if ($tamano_imagen <= 2000000) {
                            if ($tipo_imagen == "image/jpeg" || $tipo_imagen == "image/jpg" || $tipo_imagen = "image/png") {
                                if (move_uploaded_file($guardado, '../../images/'.$nombre_imagen)) {
                                    // echo "La imagen se ha guardado correctamente";
                                    echo $nombre_imagen;
                                    try {
                                        $sql = "UPDATE usuarios SET imagen_perfil= '$nombre_imagen' WHERE id = $id_usuario";	
                                        $query = mysqli_query($db,$sql);	
                                    } 
                                    catch (Exception $e) {
                                        var_dump($e->getMessage());
                                    }
                                }
                            }
                        }
                }	
                else{
                    $validate_imagen = false;
                    header('Location: ../../editar_portada.php');
                }
            }
        }
        


        header('Location: ../../perfil.php');
		

	endif;



 ?>
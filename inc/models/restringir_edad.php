<?php 

    if (isset($_POST)) {
        require_once '../functions/conn.php';

        $restriccion = $_POST['restriccion'];

        echo $restriccion;

         $_SESSION['restriccion'] = $restriccion;
                
    }

    header('Location:'.$_SERVER[HTTP_REFERER]);


?>
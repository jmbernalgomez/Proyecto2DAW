<?php 

	require '../functions/conn.php';
	if (!isset($_POST)) :
		header('Location: ../../index.php');
    else:

        $pass = $_POST['pass'];
        $passRepite = $_POST['repitepass'];
        $email = $_GET['email'];

        if($pass == $passRepite){
            $secure_pass = password_hash($pass, PASSWORD_BCRYPT); //Contraseña cifrada
            $sql = "UPDATE usuarios SET passwordc = '".$secure_pass."' WHERE email = '".$email."'";
            $query = mysqli_query($db,$sql);
            header('Location: ../../index.php');
        }
        else{
            ?>

                <script>
                    alert("Las contraseñas deben coincidir");
                    window.location.href = "<?= $_SERVER['HTTP_REFERER'] ?>";
                </script>

            <?php 
        }

		

		

	endif;



 ?>
<?php 
if (!isset($_GET['token'])) :
		header('Location: index.php');
else :

    $email = $_GET['email'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Konema | Plataforma de vídeos</title>
    <link rel="icon" href="./images/favicon.ico">
    <link rel="stylesheet" href="//stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            background: linear-gradient(to bottom, rgba(26,26,26,1) 0%, rgba(26,26,26,1) 3%, rgba(13,13,13,1) 78%, rgba(13,13,13,1) 100%);;
            background-repeat: no-repeat;
            background-size: cover;
            height: 100vh;
        }
        .botones{
			background: #2abf88;
			color: white;
		}
		.botones:hover{
			background: #24af7a;
			color: white;
		}
    </style>
</head>
<body class="d-flex justify-content-center align-items-center">
    <div class="w-25">
        <div class="d-flex mb-2">
            <img src="images/k.jpg" width="60">
            <img src="images/k1.jpg" width="60">
        </div>
        <form action="inc/models/cambio_pass.php?email=<?= $email ?>" method="POST" class="bg-light border p-4">
            <div class="form-group">
                <label for="exampleInputPassword1">Nueva contraseña</label>
                <input type="password" class="form-control rounded-0" name="pass" id="exampleInputPassword1" placeholder="Contraseña">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword2">Repita la nueva contraseña</label>
                <input type="password" class="form-control rounded-0" name="repitepass" id="exampleInputPassword2" placeholder="Repita contraseña">
            </div>
            <button type="submit" class="btn btn-block rounded-0 botones">Guardar contraseña</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>

<?php endif; ?>
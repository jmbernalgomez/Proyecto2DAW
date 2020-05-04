<?php
	if (!isset($_SESSION)) {
		session_start();
	}
?>
<?php
	require 'inc/functions/funciones.php';
	require 'inc/functions/errors.php';
?>
<?php
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
	}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Konema | Plataforma de vídeos</title>
	<!-- <link rel="stylesheet" type="text/css" href="./css/styles.css"> -->
	<link rel="stylesheet" href="//stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="//fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
	<link rel="icon" href="./images/favicon.ico">
	<link href="https://unpkg.com/video.js/dist/video-js.min.css" rel="stylesheet">
	<script src="https://unpkg.com/video.js/dist/video.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
	<style>
		.navFondo{
			background: white;
			border-bottom: 6px solid #4ca875;
		}
		.logo{
			width: 130px; 
			height: 35px;
		}
		.negro{
			color: #2b2b2b !important;
		}
		.blanco{
			color: white !important;
		}
		.buscador{
			width: 500px !important;
		}
		.botones, .iconos{
			background: #4ca875;
			color: white;
		}
		.botones:hover{
			background: #6dc493;
			color: white;
		}
		.botones-outline{
			background: white;
			color: #4ca875;
			border: 2px solid #4ca875; 
		}
		.botones-outline:hover{
			background: #4ca875;
			color: white;
		}
		.botones-outline-disabled{
			background: white;
			color: #2b2b2b !important;
			border: 2px solid #2b2b2b; 
		}
		/* #4ca875 verde */
		/* #4CAC77 verde*/
		input:focus, input.form-control:focus, textarea:focus{
			outline: 1px solid #4ca875 !important;
			box-shadow: none;
		}
		.navbar-toggler{
			outline:none !important;
		}
		.enlaceMenu{
			text-decoration:none;
			color: #2b2b2b !important;
		}
		.enlaceMenu:hover{
			text-decoration:none;
			color: #4ca875 !important;
		}
		.misvideos{
			border: 6px solid #4ca875;
		}
		.dropdown-item:active, .dropdown-item:focus{
			background: #4ca875 !important;
			color: white;
		}
		.vjs-big-play-button{
			background: rgba(0, 0, 0, 0.8) !important;
			border: none !important;
			border-radius: 100% !important;
			width: 60px !important;
			height: 60px !important;
			line-height: 60px !important;
		}
		.vjs-big-play-button:hover{
			background: #30B157 !important;
			
		}
		.vjs-control-bar{
			color: white;
			background: rgba(0,0,0,0.8) !important;
		}
		.enlacesFooter{
			text-decoration: none;
			color: white;
		}
		.enlacesFooter:hover{
			text-decoration: none;
			color: #4ca875;
		}

	</style>
</head>
<body>

	<header class="sticky-top py-1 navFondo">
		<nav class="navbar navbar-expand-lg navbar-light py-2 pl-lg-5 pr-lg-5">
		  <a class="navbar-brand" href="index.php">
		  	<img src="images/logo1.png" class="logo">
		  </a>

		  <?php if (isset($_SESSION['user'])) : ?>	
		  <a class="negro ml-auto d-block d-lg-none" style="font-size: 20px" href="entradas.php"><i class="fa fa-video-camera"></i></a>
		  <?php endif; ?>

		  <button class="navbar-toggler border-0 p-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		  	<?php if (isset($_SESSION['user'])) : ?>
				<?php $imagenPerfil = getPerfil(); ?>
				<img class="ml-3 rounded-circle" style="width: 35px; height: 35px" src="images/<?= $imagenPerfil ?>">
			<?php else : ?>
				<img class="rounded-circle" style="width: 35px; height: 35px" src="images/usuario.jpg">
			<?php endif; ?>
		  </button>

		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		  	<form class="form-inline mx-auto d-none d-lg-flex" action="videos.php" method="post">
				<div class="form-group">
					<input type="text" class="form-control rounded-0 buscador" name="busqueda" placeholder="Buscar" required>
				</div>
				<button type="submit" class="btn botones rounded-0"><i class="fa fa-search"></i></button>
			</form>
		
		  <?php if (isset($_SESSION['user'])) : ?> <!-- HABILITAR BOTON CUANDO EXISTA SESION -->
			<ul class="navbar-nav d-none d-lg-flex">
				<li class="nav-item">
					<a class="nav-link negro" href="entradas.php" tabindex="-1" aria-disabled="true"><i class="fa fa-video-camera" style="font-size: 18px"></i></a>
				</li>
				<?php $imagenPerfil = getPerfil(); ?>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle negro" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<img class="rounded-circle" style="width: 30px; height: 30px" src="images/<?= $imagenPerfil ?>">
					</a>
					<div class="dropdown-menu rounded-0 dropdown-menu-sm-right" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="entradas.php">Mis Vídeos</a>
					<a class="dropdown-item" href="favoritos.php">Favoritos</a>
					<a class="dropdown-item" href="perfil.php">Mi perfil</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="./inc/models/cerrar_sesion.php">Cerrar sesión</a>
				</li>
			</ul>
			<div class="d-block d-lg-none">
				<p class="my-2"><a class="enlaceMenu" href="entradas.php">Mis Vídeos</a></p>
				<p class="mb-2"><a class="enlaceMenu" href="favoritos.php">Favoritos</a></p>
				<p class="mb-2"><a class="enlaceMenu" href="perfil.php">Mi perfil</a></p>
				<div class="dropdown-divider"></div>
				<p class="mb-0"><a class="enlaceMenu" href="./inc/models/cerrar_sesion.php">Cerrar sesión</a></p>
			</div>
			<?php else : ?>
				<div class="d-block d-lg-none">
					<form action="inc/models/login.php" method="POST">
			
						<p class="my-2 font-weight-bold">Iniciar Sesión</i></h5>
						<div class="form-group">
							<label for="exampleInputEmail1">Email</label>
							<input type="email" name="email" class="form-control rounded-0" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email">
						</div>
						<div class="form-group">
								<label for="exampleInputPassword1">Contraseña</label>
								<input type="password" name="pass" class="form-control rounded-0" id="exampleInputPassword1" placeholder="Contraseña">
						</div>
						<button type="submit" style="padding: 5px; border: 1px solid black; background: white; width: 100%">Iniciar Sesión</button>
						<p style="padding: 5px; border: 1px solid black;" class="text-center mt-2"><a href="./registro.php" style="text-decoration: none; color: black">Registrarse</a></p>
					</form>
				</div>
		    <?php endif; ?>
		    
		  </div>
		</nav>
	</header>
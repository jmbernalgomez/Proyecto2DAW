<?php include_once 'inc/layout/header.php'?> <!-- HEADER -->
<?php $videosg = getVideosGeneral() ?>
<?php $videosm = getVideosMusica() ?>
<?php $videosd = getVideosDeportes() ?>
<?php $videosv = getVideosVideojuegos() ?>

	<main class="container-fluid" style="background: rgba(0,0,0, 0.08);">

		<?php include_once 'inc/layout/buscador.php' ?> <!-- BUSCADOR --> 

		<div class="row">

			<?php include_once 'inc/layout/barra-lateral1.php' ?> <!-- Lateral -->
			
			
			<div class="col-12 col-lg-10 pt-lg-4 p-3 p-sm-5">

				<?php if(isset($_SESSION['restriccion'])) : ?>
					<div class="col-12 position-relative mt-3 rounded-0 alert alert-primary" role="alert" id="alertaR">
					<i class="fa fa-window-close position-absolute" style="top: 10px; right: 10px; cursor: pointer" onclick="cerrarAlertaR()"></i>
						Estás viendo los vídeos seleccionados para una edad <strong>a partir de <?= $_SESSION['restriccion'] ?> años</strong>.
					</div>
				<?php endif; ?>

				<div class="col-12 d-none d-lg-block p-0 position-relative mt-3" style="color: black" id="publicidad">
					<i class="fa fa-window-close position-absolute" style="top: 10px; right: 10px; cursor: pointer" onclick="cerrarPublicidad()"></i>
					<img src="images/publi.jpg" class="w-100" style="height: 120px">
				</div>

				<h5 class="mt-0 mt-lg-4 font-weight-bold" style="font-size: 22px">General</i></h5>
				<div class="row pb-2 pt-2 d-flex">

					<?php if(isset($_SESSION['restriccion'])) : ?>
						<?php $restriccion = $_SESSION['restriccion'] ?>
						<?php $videosg1 = getVideosGeneral1($restriccion) ?>
						<?php foreach ($videosg1 as $video) : ?>
						<div class="col-12 col-sm-6 col-md-4 col-lg-3 m-0 p-0">
							<div class="col-12">
								<a href="video.php?id=<?= $video['id_entrada'] ?>"> <!-- Id que recogerá el header --> 
									<img class="w-100 img-fluid" style="height: 177px" src="images/<?= $video['imagen'] ?>">
								</a>
							</div>
							<div class="col-12 row mb-4 mb-sm-4">

								<?php $titulo = $video['titulo'] ?>
								<?php $caracteres = strlen($video['titulo']) ?>
								<?php if($caracteres > 60) : ?>
									<?php $titulo = substr($video['titulo'], 0,60).'...'; ?>
								<?php endif; ?>

								<div class="col-2 mt-3">
									<img class="rounded-circle" style="width: 40px; height: 40px" src="images/<?= $video['imagen_perfil'] ?>">
								</div>
								<div class="col-10 mt-2">
									<p class="mt-2 mt-md-0 mb-0 font-weight-bold" style="line-height: 1.3"><a style="color:black; text-decoration:none; font-size:17px;" href="video.php?id=<?= $video['id_entrada'] ?>"><?= $titulo ?></a></p>
									<p class="mt-0 m-0 p-0" style="color: #5b5b5b;"><?= $video['nombre']." ".$video['apellidos'] ?></p>
								</div>
							</div>
						</div>
						<?php endforeach; ?>

					<?php else : ?>

						<?php foreach ($videosg as $video) : ?>
						<div class="col-12 col-sm-6 col-md-4 col-lg-3 m-0 p-0">
							<div class="col-12">
								<a href="video.php?id=<?= $video['id_entrada'] ?>"> <!-- Id que recogerá el header --> 
									<img class="w-100 img-fluid" style="height: 177px" src="images/<?= $video['imagen'] ?>">
								</a>
							</div>
							<div class="col-12 row mb-4 mb-sm-4">

								<?php $titulo = $video['titulo'] ?>
								<?php $caracteres = strlen($video['titulo']) ?>
								<?php if($caracteres > 60) : ?>
									<?php $titulo = substr($video['titulo'], 0,60).'...'; ?>
								<?php endif; ?>

								<div class="col-2 mt-3">
									<img class="rounded-circle" style="width: 40px; height: 40px" src="images/<?= $video['imagen_perfil'] ?>">
								</div>
								<div class="col-10 mt-2">
									<p class="mt-2 mt-md-0 mb-0 font-weight-bold" style="line-height: 1.3"><a style="color:black; text-decoration:none; font-size:17px;" href="video.php?id=<?= $video['id_entrada'] ?>"><?= $titulo ?></a></p>
									<p class="mt-0 m-0 p-0" style="color: #5b5b5b;"><?= $video['nombre']." ".$video['apellidos'] ?></p>
								</div>
							</div>
						</div>
						<?php endforeach; ?>

					<?php endif ?>

				</div>


				<h5 class="mt-1 font-weight-bold" style="font-size: 22px">Música</i></h5>
				<div class="row pb-2 pt-2 d-flex">

					<?php if(isset($_SESSION['restriccion'])) : ?>
						<?php $restriccion = $_SESSION['restriccion'] ?>
						<?php $videosm1 = getVideosMusica1($restriccion) ?>
						<?php foreach ($videosm1 as $video) : ?>
						<div class="col-12 col-sm-6 col-md-4 col-lg-3 m-0 p-0">
							<div class="col-12">
								<a href="video.php?id=<?= $video['id_entrada'] ?>"> <!-- Id que recogerá el header --> 
									<img class="w-100 img-fluid" style="height: 177px" src="images/<?= $video['imagen'] ?>">
								</a>
							</div>
							<div class="col-12 row mb-4 mb-sm-4">

								<?php $titulo = $video['titulo'] ?>
								<?php $caracteres = strlen($video['titulo']) ?>
								<?php if($caracteres > 60) : ?>
									<?php $titulo = substr($video['titulo'], 0,60).'...'; ?>
								<?php endif; ?>

								<div class="col-2 mt-3">
									<img class="rounded-circle" style="width: 40px; height: 40px" src="images/<?= $video['imagen_perfil'] ?>">
								</div>
								<div class="col-10 mt-2">
									<p class="mt-2 mt-md-0 mb-0 font-weight-bold" style="line-height: 1.3"><a style="color:black; text-decoration:none; font-size:17px;" href="video.php?id=<?= $video['id_entrada'] ?>"><?= $titulo ?></a></p>
									<p class="mt-0 m-0 p-0" style="color: #5b5b5b;"><?= $video['nombre']." ".$video['apellidos'] ?></p>
								</div>
							</div>
						</div>
						<?php endforeach; ?>

					<?php else : ?>

						<?php foreach ($videosm as $video) : ?>
						<div class="col-12 col-sm-6 col-md-4 col-lg-3 m-0 p-0">
							<div class="col-12">
								<a href="video.php?id=<?= $video['id_entrada'] ?>"> <!-- Id que recogerá el header --> 
									<img class="w-100 img-fluid" style="height: 177px" src="images/<?= $video['imagen'] ?>">
								</a>
							</div>
							<div class="col-12 row mb-4 mb-sm-4">

								<?php $titulo = $video['titulo'] ?>
								<?php $caracteres = strlen($video['titulo']) ?>
								<?php if($caracteres > 60) : ?>
									<?php $titulo = substr($video['titulo'], 0,60).'...'; ?>
								<?php endif; ?>

								<div class="col-2 mt-3">
									<img class="rounded-circle" style="width: 40px; height: 40px" src="images/<?= $video['imagen_perfil'] ?>">
								</div>
								<div class="col-10 mt-2">
									<p class="mt-2 mt-md-0 mb-0 font-weight-bold" style="line-height: 1.3"><a style="color:black; text-decoration:none; font-size:17px;" href="video.php?id=<?= $video['id_entrada'] ?>"><?= $titulo ?></a></p>
									<p class="mt-0 m-0 p-0" style="color: #5b5b5b;"><?= $video['nombre']." ".$video['apellidos'] ?></p>
								</div>
							</div>
						</div>
						<?php endforeach; ?>

					<?php endif ?>
				</div>

				<h5 class="mt-1 font-weight-bold" style="font-size: 22px">Deportes</i></h5>
				<div class="row pb-2 pt-2 d-flex">

					<?php if(isset($_SESSION['restriccion'])) : ?>
						<?php $restriccion = $_SESSION['restriccion'] ?>
						<?php $videosd1 = getVideosDeportes1($restriccion) ?>
						<?php foreach ($videosd1 as $video) : ?>
						<div class="col-12 col-sm-6 col-md-4 col-lg-3 m-0 p-0">
							<div class="col-12">
								<a href="video.php?id=<?= $video['id_entrada'] ?>"> <!-- Id que recogerá el header --> 
									<img class="w-100 img-fluid" style="height: 177px" src="images/<?= $video['imagen'] ?>">
								</a>
							</div>
							<div class="col-12 row mb-4 mb-sm-4">

								<?php $titulo = $video['titulo'] ?>
								<?php $caracteres = strlen($video['titulo']) ?>
								<?php if($caracteres > 60) : ?>
									<?php $titulo = substr($video['titulo'], 0,60).'...'; ?>
								<?php endif; ?>

								<div class="col-2 mt-3">
									<img class="rounded-circle" style="width: 40px; height: 40px" src="images/<?= $video['imagen_perfil'] ?>">
								</div>
								<div class="col-10 mt-2">
									<p class="mt-2 mt-md-0 mb-0 font-weight-bold" style="line-height: 1.3"><a style="color:black; text-decoration:none; font-size:17px;" href="video.php?id=<?= $video['id_entrada'] ?>"><?= $titulo ?></a></p>
									<p class="mt-0 m-0 p-0" style="color: #5b5b5b;"><?= $video['nombre']." ".$video['apellidos'] ?></p>
								</div>
							</div>
						</div>
						<?php endforeach; ?>

					<?php else : ?>

						<?php foreach ($videosd as $video) : ?>
						<div class="col-12 col-sm-6 col-md-4 col-lg-3 m-0 p-0">
							<div class="col-12">
								<a href="video.php?id=<?= $video['id_entrada'] ?>"> <!-- Id que recogerá el header --> 
									<img class="w-100 img-fluid" style="height: 177px" src="images/<?= $video['imagen'] ?>">
								</a>
							</div>
							<div class="col-12 row mb-4 mb-sm-4">

								<?php $titulo = $video['titulo'] ?>
								<?php $caracteres = strlen($video['titulo']) ?>
								<?php if($caracteres > 60) : ?>
									<?php $titulo = substr($video['titulo'], 0,60).'...'; ?>
								<?php endif; ?>

								<div class="col-2 mt-3">
									<img class="rounded-circle" style="width: 40px; height: 40px" src="images/<?= $video['imagen_perfil'] ?>">
								</div>
								<div class="col-10 mt-2">
									<p class="mt-2 mt-md-0 mb-0 font-weight-bold" style="line-height: 1.3"><a style="color:black; text-decoration:none; font-size:17px;" href="video.php?id=<?= $video['id_entrada'] ?>"><?= $titulo ?></a></p>
									<p class="mt-0 m-0 p-0" style="color: #5b5b5b;"><?= $video['nombre']." ".$video['apellidos'] ?></p>
								</div>
							</div>
						</div>
						<?php endforeach; ?>

					<?php endif ?>
				</div>


				<h5 class="mt-1 font-weight-bold" style="font-size: 22px">Videojuegos</i></h5>
				<div class="row pb-5 mb-5 pt-2 d-flex">

					<?php if(isset($_SESSION['restriccion'])) : ?>
						<?php $restriccion = $_SESSION['restriccion'] ?>
						<?php $videosv1 = getVideosVideojuegos1($restriccion) ?>
						<?php foreach ($videosv1 as $video) : ?>
						<div class="col-12 col-sm-6 col-md-4 col-lg-3 m-0 p-0">
							<div class="col-12">
								<a href="video.php?id=<?= $video['id_entrada'] ?>"> <!-- Id que recogerá el header --> 
									<img class="w-100 img-fluid" style="height: 177px" src="images/<?= $video['imagen'] ?>">
								</a>
							</div>
							<div class="col-12 row mb-4 mb-sm-4">

								<?php $titulo = $video['titulo'] ?>
								<?php $caracteres = strlen($video['titulo']) ?>
								<?php if($caracteres > 60) : ?>
									<?php $titulo = substr($video['titulo'], 0,60).'...'; ?>
								<?php endif; ?>

								<div class="col-2 mt-3">
									<img class="rounded-circle" style="width: 40px; height: 40px" src="images/<?= $video['imagen_perfil'] ?>">
								</div>
								<div class="col-10 mt-2">
									<p class="mt-2 mt-md-0 mb-0 font-weight-bold" style="line-height: 1.3"><a style="color:black; text-decoration:none; font-size:17px;" href="video.php?id=<?= $video['id_entrada'] ?>"><?= $titulo ?></a></p>
									<p class="mt-0 m-0 p-0" style="color: #5b5b5b;"><?= $video['nombre']." ".$video['apellidos'] ?></p>
								</div>
							</div>
						</div>
						<?php endforeach; ?>

					<?php else : ?>

						<?php foreach ($videosv as $video) : ?>
						<div class="col-12 col-sm-6 col-md-4 col-lg-3 m-0 p-0">
							<div class="col-12">
								<a href="video.php?id=<?= $video['id_entrada'] ?>"> <!-- Id que recogerá el header --> 
									<img class="w-100 img-fluid" style="height: 177px" src="images/<?= $video['imagen'] ?>">
								</a>
							</div>
							<div class="col-12 row mb-4 mb-sm-4">

								<?php $titulo = $video['titulo'] ?>
								<?php $caracteres = strlen($video['titulo']) ?>
								<?php if($caracteres > 60) : ?>
									<?php $titulo = substr($video['titulo'], 0,60).'...'; ?>
								<?php endif; ?>

								<div class="col-2 mt-3">
									<img class="rounded-circle" style="width: 40px; height: 40px" src="images/<?= $video['imagen_perfil'] ?>">
								</div>
								<div class="col-10 mt-2">
									<p class="mt-2 mt-md-0 mb-0 font-weight-bold" style="line-height: 1.3"><a style="color:black; text-decoration:none; font-size:17px;" href="video.php?id=<?= $video['id_entrada'] ?>"><?= $titulo ?></a></p>
									<p class="mt-0 m-0 p-0" style="color: #5b5b5b;"><?= $video['nombre']." ".$video['apellidos'] ?></p>
								</div>
							</div>
						</div>
						<?php endforeach; ?>

					<?php endif ?>
				</div>

				<!-- <div>
					<a href="videos.php" class="btn btn-success mt-3 btn-block">Ver todos los vídeos</a>
				</div> -->

			</div>

		</div>
		

	</main>

	<script>
		function cerrarPublicidad(){
			var publicidad = document.getElementById("publicidad");
			publicidad.classList.remove("d-lg-block");
		}

		function cerrarAlertaR(){
			var alertaR = document.getElementById("alertaR");
			alertaR.classList.add("d-none");
		}
	</script>

	<?php include_once 'inc/layout/footer.php' ?> <!-- FOOTER -->
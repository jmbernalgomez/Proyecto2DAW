<?php include_once 'inc/layout/header.php'?> <!-- HEADER -->
<?php $busqueda = (isset($_POST['busqueda'])) ? $_POST['busqueda'] : $_GET['busqueda']; ?>
<?php $videos = getVideosALL($busqueda) ?>
<?php $videosBuscados = $videos->fetch_assoc() ?>
<?php $canales = getCanalesALL($busqueda) ?>
<?php $canalesBuscados = $canales->fetch_assoc() ?>
<?php $videosCanalBuscados = getVideosCanales($busqueda) ?>


	<main class="container-fluid">

		<?php include_once 'inc/layout/buscador.php' ?> <!-- BUSCADOR --> 

		<div class="row row pt-0 p-sm-5">
			<div class="col-12 col-lg-9 pt-0 pl-sm-0">

				<div class="row">

					<?php if($videosBuscados['cuentaTotal'] == 0 && $canalesBuscados['cuentaTotal'] == 0) : ?>
						<div class="col-12 mb-5">
							<h5>No se han encontrado resultados para "<?= $busqueda ?>"</h5>
							<p class="mb-0 mb-lg-5">Prueba con otras palabras clave</p>
							<div class="col-12 text-center mb-5 pb-5">
								<img class=" mt-5" src="images/noresults1.png">
							</div>
							
						</div>
					<?php else : ?>

						<?php if($canalesBuscados['cuentaTotal'] == 0) : ?>
                        
							<?php foreach ($videos as $video) : ?>
								<?php
									$tags = $video['tags'].'-';
									$tagsArray = [];
									$str = '';
									for ($i=0; $i < strlen($tags) ; $i++) { 
										if ($tags[$i] == '-') {
											array_push($tagsArray, $str);
											$str = '';
										}
										else{
											$str = $str.$tags[$i];
										}
									} 
								?>

								<?php $descripcion = substr($video['descripcion'], 0,160); ?>

								<div class="col-12 col-md-3 mb-0 mb-sm-4">
									<a href="video.php?id=<?= $video['id'] ?>"> 
										<img src="images/<?= $video['imagen'] ?>" class="w-100" style="height: 177px">
									</a>
								</div>

								<div class="col-12 col-md-9 mb-4 mb-sm-4">
									<h5 class="mt-3 mt-md-0"><?= $video['titulo'] ?></h5>
									<p><?= $descripcion.'...' ?></p>
									<div class="mb-2">
									<?php for ($i=0; $i < count($tagsArray) ; $i++) : ?>
										<span class="badge badge-dark rounded-0"><?= strtoupper($tagsArray[$i]) ?></span>
									<?php endfor; ?>
									</div>
									
								</div>
							<?php endforeach; ?>
						<?php else : ?>

							<?php $cuenta_suscritos = getCuentaSuscripcionesCanal($canalesBuscados['id']) ?>
							<?php $cuenta_suscritos = $cuenta_suscritos->fetch_assoc() ?>
							<?php $cuenta_videos = getCuentaVideosCanal($canalesBuscados['id']) ?>
							<?php $cuenta_videos = $cuenta_videos->fetch_assoc() ?>
							<?php if (isset($_SESSION['user'])): ?>
								<?php $suscripcion = getSuscripcion($canalesBuscados['id']) ?>
								<?php $suscripcion = $suscripcion->fetch_assoc() ?>
							<?php endif ?>

							<?php foreach ($canales as $canal) : ?>

								<div class="border-bottom col-12 col-md-3 pb-4 mb-0 mb-sm-4 text-center">
									<a href="perfil-usuario.php?id_sus=<?= $canal['id'] ?>"> 
										<img src="images/<?= $canal['imagen_perfil'] ?>" class="rounded-circle" style="width:150px; height: 140px">
									</a>
								</div>

								<div class="border-bottom col-12 col-md-9 mb-4 pb-4">
									<h5 class="mt-3 mt-md-0"><?= $canal['nombre'].' '.$canal['apellidos'] ?></h5>
									<p><?= $cuenta_suscritos['cuenta'] ?> suscriptores | <?= $cuenta_videos['cuenta'] ?> vídeos</p>
									<?php if (isset($_SESSION['user'])): ?>
										<?php if ($canal['id'] == $_SESSION['user']['id']): ?>
											<button class="btn botones-outline-disabled btn-sm-block rounded-0" disabled>Suscribirse</button>
										<?php else: ?>
											<?php if ($suscripcion['id_suscrito'] == $canal['id']): ?>
												<button class="btn botones btn-sm-block rounded-0" onclick="location.href='inc/models/suscripciones.php?id_usuario=<?= $canal['id'] ?>&id_suscripcion=<?php $suscripcion['id_suscripciones'] ?>&busqueda=<?= $busqueda ?>'" >Suscrito</a></button>
											<?php else: ?>
												<button class="btn botones-outline btn-sm-block rounded-0" onclick="location.href='inc/models/suscripciones.php?id_usuario=<?= $canal['id'] ?>&busqueda=<?= $busqueda ?>'" >Suscribirse</a></button>
											<?php endif ?>
										<?php endif ?>
									<?php else: ?>
										<button class="btn botones-outline-disabled btn-sm-block rounded-0" disabled>Suscribirse</button>
									<?php endif ?>
								</div>

							<?php endforeach; ?>
							
							
							<div class="col-12">
								<h5 class=" mb-4 font-weight-bold" style="font-size: 20px">Lo último de <?= $canalesBuscados['nombre'] ?></i></h5>
							</div>

							<?php foreach ($videosCanalBuscados as $videoCanalBuscados) : ?>
								<?php
									$tags = $videoCanalBuscados['tags'].'-';
									$tagsArray = [];
									$str = '';
									for ($i=0; $i < strlen($tags) ; $i++) { 
										if ($tags[$i] == '-') {
											array_push($tagsArray, $str);
											$str = '';
										}
										else{
											$str = $str.$tags[$i];
										}
									} 
								?>

								<?php $descripcion = substr($videoCanalBuscados['descripcion'], 0,160); ?>

								<div class="col-12 col-md-3 mb-0 mb-sm-4">
									<a href="video.php?id=<?= $videoCanalBuscados['id'] ?>"> 
										<img src="images/<?= $videoCanalBuscados['imagen'] ?>" class="w-100" style="height: 177px">
									</a>
								</div>

								<div class="col-12 col-md-9 mb-4 mb-sm-4">
									<h5 class="mt-3 mt-md-0"><?= $videoCanalBuscados['titulo'] ?></h5>
									<p><?= $descripcion.'...' ?></p>
									<div class="mb-2">
									<?php for ($i=0; $i < count($tagsArray) ; $i++) : ?>
										<span class="badge badge-dark rounded-0"><?= strtoupper($tagsArray[$i]) ?></span>
									<?php endfor; ?>
									</div>
									
								</div>
							<?php endforeach; ?>

						<?php endif; ?>

					<?php endif; ?>

				</div>

			</div>	

			
			<?php include_once 'inc/layout/barra-lateral.php' ?> <!-- Lateral -->
			


		</div>
		

	</main>

	<?php include_once 'inc/layout/footer.php' ?> <!-- FOOTER -->
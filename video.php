<?php include_once 'inc/layout/header.php'?> <!-- HEADER -->
<?php $video = getEntrada($id) ?>
<?php $video = $video->fetch_assoc() ?>
<?php $id_usuario_creador = $video['id_usuario'] ?>
<?php if (isset($_SESSION['user'])): ?>
	<?php $suscripcion = getSuscripcion($id_usuario_creador) ?>
	<?php $suscripcion = $suscripcion->fetch_assoc() ?>
<?php endif ?>
<?php $cuenta_suscritos = getCuentaSuscripciones($id) ?>
<?php $cuenta_suscritos = $cuenta_suscritos->fetch_assoc() ?>
<?php $comentarios = getComentarios($id); ?>
<?php $comentarios1 = getCuentacomentarios($id) ?>
<?php $comentarios1 = $comentarios1->fetch_assoc() ?>
<?php $rCreador = getRCreador($id) ?>
<?php $rVisitantes = getRVisitante($id) ?>
<?php $rAdministrador = getRAdministrador($id) ?>
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
?> <!-- Array de los tags -->

	<main class="container-fluid">

		<?php include_once 'inc/layout/buscador.php' ?> <!-- BUSCADOR --> 

		<div class="row pt-0 p-sm-5">
			<div class="col-12 col-lg-9 pt-0 pl-sm-0">

				<div class="mb-3">
					<video controls poster="images/<?= $video['imagen'] ?>" id="videoReproductor" data-setup="{}" class="videoClases vjs-16-9 vjs-big-play-centered video-js">
						<source src="videos/<?= $video['urlv'] ?>" type="video/mp4">
					</video>
				</div>

				<?php if (isset($id)): ?>
					<?php $likes = getLikes($id) ?>
					<?php $likes = $likes->fetch_assoc(); ?>
					<?php if (isset($_SESSION['user'])): ?>
						<?php $like = getLike($id); ?>
						<?php $like = $like->fetch_assoc(); ?>
					<?php endif ?>
				<?php endif ?>
				

				<div>
					<h5 class="font-weight-bold"><?= $video['titulo'] ?></h5>
					<div class="mb-2">
						<span class="badge badge-primary p-2 rounded-0" data-toggle="tooltip" data-placement="bottom" title="Recomendación del creador">
							<?php echo ($rCreador==0) ? 'N' : '+'.$rCreador; ?></span>
						</span>
						<span data-toggle="tooltip" data-placement="bottom" title="Recomendación media de los visitantes">
							<?php if (isset($_SESSION['user']) && $id_usuario_creador != $_SESSION['user']['id']) : ?>
								<span class="badge badge-warning p-2 rounded-0" style="cursor: pointer" data-toggle="modal" data-target="#ModalReco">
									<?php echo ($rVisitantes==0) ? 'N' : '+'.$rVisitantes; ?></span>
								</span>
							<?php else : ?>
								<span class="badge badge-warning p-2 rounded-0" data-toggle="modal" data-target="#ModalReco">
									<?php echo ($rVisitantes==0) ? 'N' : '+'.$rVisitantes; ?></span>
								</span>
							<?php endif; ?>
						</span>
						<span class="badge badge-dark p-2 rounded-0" data-toggle="tooltip" data-placement="bottom" title="Recomendación del administrador">
							<?php echo ($rAdministrador==0) ? 'N' : '+'.$rAdministrador; ?></span>
						</span>
					</div>

					<!-- <div class="form-group d-flex justify-content-end" style="margin-top: -35px;">
						<select class="form-control rounded-0" id="exampleFormControlSelect1" name="voto" style="width: 80px;">
							<option selected>+3</option>
							<option>+7</option>
							<option>+18</option>
						</select>
					</div> -->
					<div style="text-align: right;">
						
						<?php 
						if (isset($_SESSION['user'])) : ?>
							<?php if ($like['id_usuario'] == $_SESSION['user']['id']): ?>
								<a href="inc/models/likes.php?id_entrada=<?= $video['id_entrada'] ?>&estado=1&id_like=<?= $like['id'] ?>" style="text-decoration: none; color: #4ca875;"><span><i class="fa fa-thumbs-up"></i>&nbsp;<?= $likes['likes'] ?></span></a>
							<?php else: ?>	
								<a href="inc/models/likes.php?id_entrada=<?= $video['id_entrada'] ?>&estado=0&id_like=<?= $like['id'] ?>" style="text-decoration: none; color: grey;"><span><i class="fa fa-thumbs-o-up"></i>&nbsp;<?= $likes['likes'] ?></span></a>						
							<?php endif ?>	
						<?php else : ?> 
							<span style="color: grey"><i class="fa fa-thumbs-up"></i>&nbsp;<?= $likes['likes'] ?></span>
					<?php endif; ?>
					</div>
					<div style="text-align: left; margin-top: -25px; color: grey;">
						<span><?= $video['fecha_subida'] ?></span>
					</div>
				</div>
				<div class="clearfix mb-2"></div>
				<div class="mb-4 pt-3 border-top">
					<div class="float-right">
						<?php if (isset($_SESSION['user'])): ?>
						<!-- MODAL DE RECOMENDACIONES -->
							<div class="modal fade rounded-0" id="ModalReco" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalCenterTitle">Recomendación media de los visitantes</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<p>Vota para que los demás visitantes puedan ver tu recomendación de edad.</p>
										<form action="inc/models/votos_visitantes.php?id_entrada=<?= $id ?>&id_usuario=<?= $_SESSION['user']['id'] ?>" method="POST">
										<div class="input-group mt-3 mb-4">
											<select class="form-control rounded-0" name="recomendacion" required>
											<option value="" selected disabled>Elegir recomendacion</option>
											<option value="3">+3</option>
											<option value="7">+7</option>
											<option value="18">+18</option>
											</select>
										</div>
										<div class="alert alert-warning rounded-0" role="alert">
											Si ya has votado antes, se borrará tu antiguo voto.
										</div>
									</div>
									<div class="modal-footer">
										<button type="submit" class="btn botones rounded-0">Enviar votación</button>
									</div>
									</form>
									</div>
								</div>
							</div>



							<?php if ($video['id_usuario'] == $_SESSION['user']['id']): ?>
								<button class="btn botones-outline-disabled btn-sm-block rounded-0" disabled>Suscribirse</button>
							<?php else: ?>
								<?php if ($suscripcion['id_suscrito'] == $video['id_usuario']): ?>
									<button class="btn botones btn-sm-block rounded-0" onclick="location.href='inc/models/suscripciones.php?id_usuario=<?= $video['id_usuario']?>&id_suscripcion=<?php $suscripcion['id_suscripciones'] ?>'" >Suscrito</a></button>
								<?php else: ?>
									<button class="btn botones-outline btn-sm-block rounded-0" onclick="location.href='inc/models/suscripciones.php?id_usuario=<?= $video['id_usuario'] ?>'" >Suscribirse</a></button>
								<?php endif ?>
							<?php endif ?>
						<?php else: ?>
							<button class="btn botones-outline-disabled btn-sm-block rounded-0" disabled>Suscribirse</button>
						<?php endif ?>
					</div>
					<div class="float-left mr-3">
						<img src="images/<?= $video['imagen_perfil'] ?>" class="rounded-circle" style="width: 50px; height: 50px">
					</div>
					<p class="mt-1"><?= $video['nombre'].' '.$video['apellidos'] ?></p>
					<p style="color: grey; margin-top:-20px !important;"><?= $cuenta_suscritos['cuenta'] ?> Suscriptores</p>
				</div>
				<div>
					<p><?= $video['descripcion'] ?></p>
					<p style="color: grey">Categoría&nbsp;&nbsp;&nbsp;&nbsp;<span style="color: #068acc"><?= $video['categoria'] ?></span></p>
				<div class="mb-2 pb-3 float-left">
					<?php for ($i=0; $i < count($tagsArray) ; $i++) : ?>
						<span class="badge badge-dark rounded-0"><?= strtoupper($tagsArray[$i]) ?></span>
					<?php endfor; ?>
				</div>
				</div>
				
				<div class="clearfix"></div>
				<div class="mb-5 mb-md-0">
					<form action="inc/models/comentarios.php?id_entrada=<?= $id ?>" method="POST">
						<div class="form-group">
						  <label class="mb-0"><?= $comentarios1['cuenta']?> Comentarios</label>
						  <?php if (isset($_SESSION['user'])): ?>
							<p class="mb-0 text-right" style="margin-top: -25px;"><label for="mi"><span id="info">(0/150)</span></label></p>
						  	<textarea onkeypress="return limita(event, 150);" onkeyup="actualizaInfo(150)"  id="mi" class="form-control rounded-0" placeholder="Vas a comentar de forma pública como <?= $_SESSION['user']['nombre'].' '.$_SESSION['user']['apellidos'] ?>" name="mi" rows="3"></textarea>
						  <?php endif ?>
						</div>
						<?php if (isset($_SESSION['user'])): ?>
						<div class="d-flex justify-content-end">
							<button type="submit" class="btn btn-dark btn-sm-block mb-4 rounded-0">Comentar</button>
						</div>
						<?php endif ?>
					</form>
					<?php foreach ($comentarios as $j=>$comentario) : ?>
					<div class="row mt-2 m-0 rounded-0 pt-3 pb-1" style="margin-bottom: 0px !important;" role="alert">
						<div class="col-10 p-0">
							<div class="float-left mr-3">
								<img src="images/<?= $comentario['imagen_perfil'] ?>" style="width: 50px; height: 50px" class="rounded-circle">
							</div>
							<h6 class="font-weight-bold mb-0"><?= $comentario['nombre'].' '.$comentario['apellidos'] ?></h6>
							<p class="text-break m-0 mb-2"><?= $comentario['comentario']  ?></p>

							<!-- COLLAPSE DE RESPUESTAS-->
							<p>
								<?php if(isset($_SESSION['user'])) :?> 
									<a class="text-decoration-none text-secondary" data-toggle="collapse" href="#responder<?= $j ?>" role="button" aria-expanded="false" aria-controls="collapseExample">
										Responder <i class="fa fa-reply-all"></i>
									</a>
								<?php endif; ?>
								<?php $id_comentario =  $comentario['id_comentario']?>
								<?php $respuestasComentarios = getComentariosRespuestas($id_comentario); ?>
								<?php if(mysqli_num_rows($respuestasComentarios) > 0 ) :?> //
								<a id="respuestasVer" data-toggle="collapse" href="#respuestas<?= $j ?>" role="button" aria-expanded="false" aria-controls="respuestas">
									Ver <?= mysqli_num_rows($respuestasComentarios) ?> respuestas <i class="fa fa-caret-down"></i>
								</a>
								<?php endif; ?>
								
							</p>
						</div>
						<?php if (isset($_SESSION['user']) && $comentario['id_usuario'] == $_SESSION['user']['id']): ?>
							<div class="col-2 p-0">
								<h5><a onclick="javascript: return confirm('¿Estás segur@?')" class="float-right clearfix" href="inc/models/comentarios.php?id_comentario=<?= $comentario['id_comentario'] ?>&accion=borrar"><i class="fa fa-trash" style="color: #C82333" area-hidden="true"></i></a></h5>
							</div>
						<?php endif ?>

						<!-- CONTENEDOR PARA RESPONDER -->

						<div class="container-fluid collapse mb-2" id="responder<?= $j ?>">
							<div class="card card-body p-0 border-0">
								<div class="col-12 row p-0">
									<div class="col-11 pr-0">
										<textarea onKeyDown="cuenta()" onKeyUp="cuenta()" class="form-control rounded-0" placeholder="Responder" name="comentario" id="exampleFormControlTextarea1" rows="1"></textarea>
									</div>
									<div class="d-none d-xl-block col-1">
										<button type="submit" class="btn btn-dark rounded-0">Comentar</button>
									</div>
									<div class="d-block d-xl-none col-1 p-0">
										<button type="submit" class="btn btn-dark rounded-0"><i class="fa fa-send"></i></button>
									</div>
								</div>
							</div>
						</div>
						
						<!-- CONTENEDOR DE RESPUESTAS -->

						<div class="container-fluid collapse pr-sm-0" id="respuestas<?= $j ?>">
							<div class="card card-body rounded-0 border-0 p-0">
							<?php foreach ($respuestasComentarios as $j=>$respuestasComentario) : ?>
								<div class="col-12 p-0">
									<div class="float-left mr-3">
										<img src="images/<?= $respuestasComentario['imagen_perfil'] ?>" style="width: 35px; height: 35px" class="rounded-circle">
									</div>
									<h6 class="font-weight-bold mb-0"><?= $respuestasComentario['nombre'].' '.$respuestasComentario['apellidos'] ?></h6>
									<p class="text-break m-0 mb-2"><?= $respuestasComentario['respuesta']  ?></p>
								</div>

							<?php endforeach; ?>
							</div>
						</div>
						

						

					</div>
				<?php endforeach; ?>
				</div>

			</div>

			<!-- BARRA LATERAL DIFERENTE A LAS DEMÁS -->
			<div class="col-12 col-lg-3 pb-5 pr-sm-0">

				<div class="col-12 p-0 mb-5 position-relative" id="publicidad">
					<i class="fa fa-window-close position-absolute" style="top: 10px; right: 10px; cursor: pointer" onclick="cerrarPublicidad()"></i>
					<img src="./images/publi.jpg" class="w-100" style="height: 260px">
				</div>

				<?php $videos = getVideosBL() ?>
				<?php foreach ($videos as $video ) : ?>
					<div class="row mb-3 mt-2">
						<div class="col-6">
							<a href="video.php?id=<?= $video['id_entrada'] ?>">
								<img class="w-100" src="images/<?= $video['imagen'] ?>" style="height: 90px">
							</a>
						</div>
						<div class="col-6 m-0 p-0">
							<?php 
								if(strlen($video['titulo']) > 30){
									$titulo = substr($video['titulo'], 0,30).'...';
								}
								else{
									$titulo = $video['titulo'];
								}
							?>
							<p class="font-weight-bold mt-0" style="line-height: 1.3"><a style="color:black; text-decoration:none; font-size:16px;" href="video.php?id=<?= $video['id_entrada'] ?>"><?= $titulo ?></a></p>
							<?php $caracteres = strlen($video['nombre']) + strlen($video['apellidos']) ?>
							<?php if($caracteres > 15) : ?>
								<p style="color: grey; margin-top: -16px; font-size: 15px;"><?= substr($video['nombre'].' '.$video['apellidos'], 0,18).'...' ?></p>
							<?php else : ?>
								<p style="color: grey; margin-top: -16px; font-size: 15px;"><?= $video['nombre'].' '.$video['apellidos'] ?></p>
							<?php endif; ?>
						</div>
							
					</div>
				<?php endforeach; ?>
				</div>
			</div>

			<script>
				function cerrarPublicidad(){
					var publicidad = document.getElementById("publicidad");
					publicidad.style.display = "none";
				}
				$(function () {
					$('[data-toggle="tooltip"]').tooltip();

					// RESPUESTAS DE COMENTARIOS
					$('#respuestas').on('shown.bs.collapse', function () {
					$('#respuestasVer').html("Ocultar respuestas <i class='fa fa-caret-up'></i>");
					});

					$('#respuestas').on('hidden.bs.collapse', function () {
						$('#respuestasVer').html("Ver respuestas <i class='fa fa-caret-down'></i>");
					});

					
				});

				//Limitar Caracteres
				function limita(elEvento, maximoCaracteres) {
					var elemento = document.getElementById("mi");

					// Obtener la tecla pulsada 
					var evento = elEvento || window.event;
					var codigoCaracter = evento.charCode || evento.keyCode;
					// Permitir utilizar las teclas con flecha horizontal
					if(codigoCaracter == 37 || codigoCaracter == 39) {
						return true;
					}

					// Permitir borrar con la tecla Backspace y con la tecla Supr.
					if(codigoCaracter == 8 || codigoCaracter == 46) {
						return true;
					}
					else if(elemento.value.length >= maximoCaracteres ) {
						return false;
					}
					else {
						return true;
					}
				}

				//Actualiza Caracteres
				function actualizaInfo(maximoCaracteres) {
					var elemento = document.getElementById("mi");
					var info = document.getElementById("info");

					if(elemento.value.length >= maximoCaracteres ) {
						info.innerHTML = "("+(elemento.value.length)+"/150)";
					}
					else {
						info.innerHTML = "("+(elemento.value.length)+"/150)";
					}
				}

				

			</script>
			


		</div>
		

	</main>

	<script>
		var reproductor = videojs('videoReproductor', {
			fluid: true
		});
	</script>

	<?php include_once 'inc/layout/footer.php' ?> <!-- FOOTER -->
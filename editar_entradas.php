<?php 
include_once 'inc/layout/header.php'; // HEADER
if (!isset($_SESSION['user'])) :
		header('Location: index.php');
else :
?>
<?php $video = getEntrada($id); ?>
<?php $video = $video->fetch_assoc(); ?> <!-- Poner valores en los input lo pasamos a array -->
<?php $rCreador = getRCreador($id) ?>

	<main class="container-fluid pt-5 pt-sm-0">
		<div class="row pt-0 p-sm-5" >
			<div class="col-12 col-lg-9 pt-0 pl-sm-0 pb-5 mb-5">
				<form class="pb-2" action="inc/models/entradas.php?accion=editar&id=<?= $id ?>" method="POST" enctype="multipart/form-data">
				<h5 class="font-weight-bold mb-3">EDITA EL VÍDEO</h5>
					<div class="form-group">
						<input type="text" class="form-control rounded-0" placeholder="Título del vídeo" name="titulo" value="<?= $video['titulo'] ?>">	<!-- Ponemos el valor recogiendo del array anteriormente creado de $video-->
					</div>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text rounded-0">Descripción del vídeo</span>
						</div>
						<textarea name="descripcion" class="form-control rounded-0"><?= $video['descripcion'] ?></textarea>
					</div>
					
					<div class="form-group mt-3">
						<input type="text" class="form-control rounded-0" placeholder="URL del vídeo" name="url" value="<?= $video['urlv'] ?> " disabled>
					</div>
					
					<div class="input-group mt-3">
						<div class="custom-file">
							<input type="file" class="custom-file-input" id="inputGroupFile01" name="imagen">
							<label id="inputGroupFile01" class="custom-file-label rounded-0">Miniatura del vídeo</label>
						</div>
					</div>
					<div class="input-group mt-3">
						<select class="form-control rounded-0" name="categoria" value="">
						  <option value="general" <?php echo ($video['categoria'] == 'general') ? 'selected' : '' ?>>General</option>
						  <option value="musica" <?php echo ($video['categoria'] == 'musica') ? 'selected' : '' ?>>Música</option>
						  <option value="deportes" <?php echo ($video['categoria'] == 'deportes') ? 'selected' : '' ?>>Deportes</option>
						  <option value="videojuegos" <?php echo ($video['categoria'] == 'videojuegos') ? 'selected' : '' ?>>Videojuegos</option>
						</select>
					</div>
					<div class="input-group mt-3">
						<select class="form-control rounded-0" name="recomendacion" value="">
						  <option value="3" <?php echo ($rCreador == 3) ? 'selected' : '' ?>>+3</option>
						  <option value="7" <?php echo ($rCreador == 7) ? 'selected' : '' ?>>+7</option>
						  <option value="18" <?php echo ($rCreador == 18) ? 'selected' : '' ?>>+18</option>
						</select>
					</div>
					<div class="form-group mt-3">
						<input type="text" class="form-control rounded-0" placeholder="Tags del vídeo (separar por -)" name="tags" value="<?= $video['tags'] ?>">
					</div>
					<input type="hidden" name="imagen_actual" value="<?= $video['imagen'] ?>">
					<div class="d-flex justify-content-end mb-5">
						<button type="submit" class="btn botones rounded-0">Editar Vídeo</button>
					</div>
				</form>

			</div>

			<?php include_once 'inc/layout/barra-lateral.php' ?> <!-- Lateral -->
			


		</div>
		

	</main>

	<?php endif; ?>

	<?php include_once 'inc/layout/footer.php' ?> <!-- FOOTER -->
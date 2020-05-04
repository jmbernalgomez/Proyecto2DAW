<?php 
include_once 'inc/layout/header.php'; // HEADER
if (!isset($_SESSION['user'])) :
		header('Location: index.php');
else :
?>
<?php $videos = getMisVideos(); ?>
	<main class="container-fluid pt-5 pt-sm-0">

		<div class="row pt-0 p-sm-5">
			<div class="col-12 col-lg-9 pt-0 pl-sm-0 pb-5 mb-5">
				<form class="pb-2" action="inc/models/entradas.php?accion=crear" method="POST" enctype="multipart/form-data">
					<h5 class="font-weight-bold mb-3">INTRODUCE EL VÍDEO</h5>
					<?php if (isset($_SESSION['success'])) : ?>
						<div class="alert alert-success">
							<?= $_SESSION['success'] ?>
						</div>	
					<?php elseif (isset($_SESSION['errors']['general'])) : ?>
						<div class="alert alert-danger">
							<?= $_SESSION['errors']['general'] ?>
						</div>
					<?php endif; ?>
					<div class="form-group">
						<input type="text" class="form-control rounded-0" placeholder="Título del vídeo" name="titulo" required>
					</div>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text rounded-0">Descripción del vídeo</span>
						</div>
						<textarea name="descripcion" class="form-control rounded-0" required></textarea>
					</div>
					<div class="input-group mt-3">
						<div class="custom-file">
							<input type="file" class="custom-file-input " id="inputGroupFile01" name="url" required>
							<label id="inputGroupFile01" class="custom-file-label rounded-0">Vídeo</label>
						</div>
					</div>
					<div class="input-group mt-3">
						<div class="custom-file">
							<input type="file" class="custom-file-input " id="inputGroupFile02" name="imagen" required>
							<label id="inputGroupFile01" class="custom-file-label rounded-0">Miniatura del vídeo</label>
						</div>
					</div>
					<div class="input-group mt-3">
						<select class="form-control rounded-0" name="categoria" required>
						  <option value="" selected disabled>Elegir categoría</option>
						  <option value="general">General</option>
						  <option value="musica">Música</option>
						  <option value="deportes">Deportes</option>
						  <option value="videojuegos">Videojuegos</option>
						</select>
					</div>
					<div class="input-group mt-3">
						<select class="form-control rounded-0" name="recomendacion" required>
						  <option value="" selected disabled>Elegir recomendacion</option>
						  <option value="3">+3</option>
						  <option value="7">+7</option>
						  <option value="18">+18</option>
						</select>
					</div>
					<div class="form-group mt-3">
						<input type="text" class="form-control rounded-0" placeholder="Tags del vídeo (separar por -)" name="tags" required>
					</div>
					<div class="d-flex justify-content-end">
						<button type="submit" class="btn botones rounded-0">Subir vídeo</button>
					</div>
				</form>
				
				<h5 class="mt-5 font-weight-bold">MIS VÍDEOS</h5>
				<div class="mb-5 px-4 rounded-0 misvideos">	
				<?php if(mysqli_num_rows ($videos) == 0) : ?>
					<div class="rounded-0 alert alert-primary mt-4 mb-4 pr-sm-0" role="alert">
						Todavía no has subido ninún video al canal.
					</div>
				<?php else : ?>
					<?php foreach ($videos as $video) : ?>
						<div class="row mt-4 mb-4 pr-sm-0">
							<div class="col-8 col-sm-10">	
								<a class="negro" href="video.php?id=<?= $video['id'] ?>"><?= $video['titulo'] ?></a>
							</div>
							<div class="col-2 col-sm-1 text-right">
								<a class="negro" href="editar_entradas.php?id=<?= $video['id'] ?>"><i class="fa fa-pen"></i></a>	
							</div>
							<div class="col-2 col-sm-1 text-right">
								<a onclick="javascript: return confirm('¿Estás segur@?')" href="inc/models/entradas.php?accion=eliminar&id=<?= $video['id'] ?>&imagen=<?= $video['imagen'] ?>&video=<?= $video['urlv'] ?>"><i class="fa fa-trash" style="color: #C82333"></i></a>	
							</div>
						</div>
						<div class="dropdown-divider"></div>
					<?php endforeach; ?>
				<?php endif; ?>	
				</div>

			</div>
			
			<?php include_once 'inc/layout/barra-lateral.php' ?> <!-- Lateral -->
			
		</div>
		

	</main>

	<?php endif; ?>

	<?php include_once 'inc/layout/footer.php' ?> <!-- FOOTER -->
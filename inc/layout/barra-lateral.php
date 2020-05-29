
<div class="d-none d-lg-block col-12 col-lg-3 pb-5 pr-sm-0">

		<div class="col-12 p-0 mb-5 position-relative" id="publicidad">
			<i class="fa fa-window-close position-absolute" style="top: 10px; right: 10px; cursor: pointer" onclick="cerrarPublicidad()"></i>
			<img src="./images/publicidad2.png" class="w-100" style="height: 260px">
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
</script>
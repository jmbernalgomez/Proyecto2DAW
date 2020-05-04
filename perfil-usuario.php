<?php include_once 'inc/layout/header.php'; ?>

<?php $id = $_GET['id_sus'] ?>
<?php $portada = getPortada1($id); ?>
<?php $imagenPerfil = getPerfil1($id); ?>
<?php $videosmios = getMisVideos1($id) ?>
<?php 
    $usuario = getUsuario($id) ;
    $usuario = $usuario->fetch_assoc();
?>


<main class="container-fluid">

		<?php include_once 'inc/layout/buscador.php' ?> <!-- BUSCADOR --> 

		<div class="row pt-0 p-sm-5">
			<div class="col-12 col-lg-9 pt-0 pl-sm-0">
                <?php if(isset($_SESSION['user'])) : ?>
                    <div class="p-0 mb-3" style="position: relative">
                        <img src="images/<?= $portada ?>" style="width:100%; height:200px">
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <img style="width:100px; height:100px; border-radius:100%; margin-top: -90px; margin-left:30px" src="images/<?= $imagenPerfil ?>" >
                        </div>
                        <div class="col-12 col-sm-10">
                            <h4 style="font-weight:bold;" class="mt-2"><?= mb_strtoupper($usuario['nombre'],'utf-8').' '.mb_strtoupper($usuario['apellidos'],'utf-8') ?></h4>
                        </div>
                    </div>
                   <div class="row mt-3">
                        <div class="col-12">
                            <h5 class="mt-4 mb-4 font-weight-bold" style="font-size: 20px">Videos de <?= $usuario['nombre'] ?></i></h5>
                        </div>
                        
                        <?php foreach ($videosmios as $video) : ?>
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
                   </div>
                <?php else : header("Location: index.php")  ?>
                <?php endif; ?>
			</div>

			<?php include_once 'inc/layout/barra-lateral.php' ?> <!-- Lateral -->
			


		</div>
		

	</main>

    <?php include_once 'inc/layout/footer.php' ?> <!-- FOOTER -->
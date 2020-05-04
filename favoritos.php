<?php include_once 'inc/layout/header.php' ?>
<?php if (!isset($_SESSION['user'])) : ?>
<?php header("Location: index.php") ?>
<?php else: ?>
<?php $favoritos = getFavoritos(); ?>
	<main class="container-fluid">

		<?php include_once 'inc/layout/buscador.php' ?>
        
		<div class="row pt-0 p-sm-5">
			<div class="col-12 col-lg-9 pt-0 pl-sm-0">
				<div class="row">
                        <div class="col-12">
                            <h5 class=" mb-4 font-weight-bold" style="font-size: 20px">Mis videos favoritos</i></h5>
                        </div>

                        <?php if(mysqli_num_rows ($favoritos) == 0) : ?>
                            <div class="col-12 rounded-0 alert alert-primary mb-5" role="alert">
                                Todavía no tienes ningún vídeo en favoritos. 
                            </div>
                        <?php else : ?>
                        
                            <?php foreach ($favoritos as $favorito) : ?>
                                <?php
                                    $tags = $favorito['tags'].'-';
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
                                <?php $descripcion = substr($favorito['descripcion'], 0,160); ?>
                                <div class="col-12 col-md-3 mb-0 mb-sm-4">
                                    <a href="video.php?id=<?= $favorito['id_entrada'] ?>"> 
                                        <img src="images/<?= $favorito['imagen'] ?>" class="w-100" style="height: 150px">
                                    </a>
                                </div>
                                <div class="col-12 col-md-9 mb-4 mb-sm-4">
                                    <h5 class="mt-3 mt-md-0"><?= $favorito['titulo'] ?></h5>
                                    <p><?= $descripcion.'...' ?></p>
                                    <div class="mb-2">
                                        <?php for ($i=0; $i < count($tagsArray) ; $i++) : ?>
                                                <span class="badge badge-dark rounded-0"><?= strtoupper($tagsArray[$i]) ?></span>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                </div>
				
			</div>
			<?php include_once 'inc/layout/barra-lateral.php' ?>
		</div>
	</main>
<?php include_once 'inc/layout/footer.php' ?>
<?php endif; ?>
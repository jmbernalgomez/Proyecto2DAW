<?php 
    include_once 'inc/layout/header.php';
?>

<main class="container-fluid">

		<?php include_once 'inc/layout/buscador.php' ?> <!-- BUSCADOR --> 

		<div class="row pt-0 p-sm-5">
			<div class="col-12 col-lg-9 pt-0 pl-sm-0">
                <?php if(isset($_SESSION['user'])) : ?>

                    <?php if(isset($_GET['portada'])) : ?>
                        
                        <form class="pb-2" action="inc/models/portada.php?accion=editar" method="POST" enctype="multipart/form-data">
                            <h5 class="font-weight-bold mb-3">EDITA LA PORTADA</h5>
                            <div class="input-group mt-3 mb-3">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputGroupFile01" name="imagen">
                                    <label id="inputGroupFile01" class="custom-file-label rounded-0">Imagen de portada del canal</label>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn botones rounded-0">Editar portada</button>
                            </div>
                        </form>
                        <br>
                        <p>Para cambiar la portada solo debes subir el archivo. Si quieres volver a la portada por defecto pulsa en el siguiente enlace: <a href="inc/models/portada.php?accion=borrar">PORTADA POR DEFECTO.</a></p>

                    <?php else : ?>

                        <form class="pb-2" action="inc/models/portada.php?accion=editar1" method="POST" enctype="multipart/form-data">
                            <h5 class="font-weight-bold mb-3">EDITA LA IMAGEN DE PERFIL</h5>
                            <div class="input-group mt-3 mb-3">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputGroupFile01" name="imagen">
                                    <label id="inputGroupFile01" class="custom-file-label rounded-0">Imagen de perfil del canal</label>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn botones rounded-0">Editar perfil</button>
                            </div>
                        </form>
                        <br>
                        <p>Para cambiar la imagen de perfil solo debes subir el archivo. Si quieres volver a la imagen de perfil por defecto pulsa en el siguiente enlace: <a href="inc/models/portada.php?accion=borrar1">IMAGEN POR DEFECTO.</a></p>

                    <?php endif; ?>
                
                <?php else : header("Location: index.php")  ?>
                <?php endif; ?>
			</div>

			<?php include_once 'inc/layout/barra-lateral.php' ?> <!-- Lateral -->
			


		</div>
		

	</main>

    <?php include_once 'inc/layout/footer.php' ?> <!-- FOOTER -->
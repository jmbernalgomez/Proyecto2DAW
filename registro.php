<?php include_once 'inc/layout/header.php'?> <!-- HEADER -->

	<main class="container-fluid">

		<div class="row pt-0 p-sm-5">
			<div class="col-12 col-lg-9 pt-0 pl-sm-0">
				<form class="pb-5" action="inc/models/registro.php" method="POST">
					<h5 class="font-weight-bold mb-3">REGISTRARSE</h5>
					<?php if (isset($_SESSION['success'])) : ?> <!-- Los dos puntos dejan meter HTML -->
						<div class="alert alert-success rounded-0">
							<?= $_SESSION['success'] ?>
						</div>
					<?php elseif (isset($_SESSION['errors']['general'])) : ?>
						<div class="alert alert-danger rounded-0">
							<?= $_SESSION['errors']['general'] ?>
						</div>
					<?php endif; ?>
					<div class="form-group">
    					<input type="text" name="nombre" class="form-control rounded-0" placeholder="Nombre">
    					<?= isset($_SESSION['errors']) ? alerta($_SESSION['errors'], 'nombre') : '' ?>
  					</div>
  					<div class="form-group">
    					<input type="text" name="apellidos" class="form-control rounded-0" placeholder="Apellidos">
    					<?= isset($_SESSION['errors']) ? alerta($_SESSION['errors'], 'apellidos') : '' ?>
  					</div>
  					<div class="form-group mt-3">
    					<input type="email" name="email" class="form-control rounded-0" placeholder="Email">
    					<?= isset($_SESSION['errors']) ? alerta($_SESSION['errors'], 'email') : '' ?>
  					</div>
  					<div class="form-group">
    					<input type="password" name="pass" class="form-control rounded-0" placeholder="Contraseña">
    					<?= isset($_SESSION['errors']) ? alerta($_SESSION['errors'], 'pass') : '' ?>
  					</div>
  					<div class="form-group">
    					<input type="password" name="passc" class="form-control rounded-0" placeholder="Confirmar contraseña">
    					<?= isset($_SESSION['errors']) ? alerta($_SESSION['errors'], 'passc') : '' ?>
  					</div>
  					<div class="d-flex justify-content-end">
  						<button onclick="redireccion()" type="submit" class="btn botones rounded-0">Registrarse</button>
  					</div>
				</form>

				<?php if(isset($_GET['registrado'])) : ?>
					<script>
						function redireccion() {
							setTimeout(function(){ location.href = "index.php"; }, 3000);
						};
						redireccion();
					</script>
				<?php endif; ?>


			</div>

			<?php include_once 'inc/layout/barra-lateral.php' ?> <!-- Lateral -->
			


		</div>
		

	</main>

	<?php include_once 'inc/layout/footer.php' ?> <!-- FOOTER -->
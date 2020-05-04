<?php 
include_once 'inc/layout/header.php'; // HEADER
if (!isset($_SESSION['user'])) :
		header('Location: index.php');
else :
?>
<?php $id_usuario = $_SESSION['user']['id'] ?>
<?php $usuario = getUsuario($id_usuario); ?>
<?php $usuario = $usuario->fetch_assoc(); ?>

	<main class="container-fluid pt-5 pt-sm-0">
		<div class="row pt-0 p-sm-5" >
			<div class="col-12 col-lg-9 pt-0 pl-sm-0 pb-5 mb-5">
				<form class="pb-2" action="inc/models/usuario.php?id=<?= $id_usuario ?>" method="POST">
				<h5 class="font-weight-bold mb-3">EDITAR MIS DATOS</h5>
					<div class="form-group">
						<input type="text" class="form-control rounded-0" placeholder="Nombre" name="nombre" value="<?= $usuario['nombre'] ?>" required>
					</div>
					<div class="form-group">
						<input type="text" class="form-control rounded-0" placeholder="Apellidos" name="apellidos" value="<?= $usuario['apellidos'] ?>" required>
					</div>
					<div class="form-group">
						<input type="text" class="form-control rounded-0" placeholder="Correo electrónico" name="email" value="<?= $usuario['email'] ?>" required>
					</div>
					<div class="form-group">
						<input type="password" class="form-control rounded-0" placeholder="Contraseña" name="pass" required>	
					</div>
					<div class="form-group">
						<input type="text" class="form-control rounded-0" placeholder="Fecha de registro" name="fecha" value="<?= $usuario['fecha_registro'] ?>" disabled required>	
					</div>
					<div class="d-flex justify-content-end mb-5">
						<button type="submit" class="btn botones rounded-0">Editar datos</button>
					</div>
				</form>

			</div>

			<?php include_once 'inc/layout/barra-lateral.php' ?> <!-- Lateral -->
			


		</div>
		

	</main>

	<?php endif; ?>

	<?php include_once 'inc/layout/footer.php' ?> <!-- FOOTER -->
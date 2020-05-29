
<div class="col-12 col-lg-2" style="background: white;">

    <?php if(isset($_SESSION['user'])) : ?>

        <?php $id_usuario = $_SESSION['user']['id'] ?>
        <?php $usuario = getUsuario($id_usuario); ?>
        <?php $usuario = $usuario->fetch_assoc(); ?>

        <a href="index.php" class="btn w-100 rounded-0 pl-1 mt-4 text-left"><i class="fa fa-home mr-4"></i> Página principal</a>
        <a href="index.php" class="btn w-100 rounded-0 pl-1 text-left"><i class="fa fa-fire mr-4"></i> Tendencias</a>
        <a href="favoritos.php" class="btn w-100 rounded-0 pl-1 text-left"><i class="fa fa-star mr-4"></i> Favoritos</a>

        <?php $imagenPerfil = getPerfil(); ?>

        <h5 class="mt-4 mb-3 font-weight-bold" style="font-size: 20px">Mi cuenta</i></h5>

        <div class="col-12 text-center">
            <img class="rounded-circle" style="width: 115px; height: 110px" src="images/<?= $imagenPerfil ?>">
        </div>
        <div class="col-12 mt-3 p-0 text-justify">
            <p class="font-weight-bold text-center" style="padding: 5px; background: #2abf88; color: white"><?= mb_strtoupper($usuario['nombre'].' '. $usuario['apellidos'], 'utf-8') ?></p>
        </div>
        <div class="col-12 p-0">
            <p style="padding: 5px; border: 1px solid black;" class="text-center"><a href="./inc/models/cerrar_sesion.php" style="text-decoration: none; color: black">Cerrar Sesión</a></p>
        </div>
        
        

        <h5 class="mt-4 mb-4 font-weight-bold" style="font-size: 20px">Suscripciones</i></h5>
        <?php $suscripciones = getSuscripciones(); ?>

        <div class="pb-5">
        <?php if(mysqli_num_rows ($suscripciones) == 0) : ?>
            <div class="rounded-0 alert alert-primary" role="alert">
                Todavía no estás suscrito a ningún canal.
            </div>
        <?php else : ?>

            <?php foreach ($suscripciones as $suscripcion): ?>

            <div class="row col-12 p-0 mt-2">
                <div class="col-2 mt-0">
                    <img class="rounded-circle" style="width: 35px; height: 35px" src="images/<?= $suscripcion['imagen_perfil'] ?>">
                </div>
                <div class="col-10">
                    <?php $caracteres = strlen($suscripcion['nombre']) + strlen($suscripcion['apellidos']) ?>
                    <?php if($caracteres > 15) : ?>
                        <p class="pl-2"><a style="color: black" href="perfil-usuario.php?id_sus=<?= $suscripcion['id_suscrito'] ?>"><?= substr($suscripcion['nombre'].' '.$suscripcion['apellidos'], 0,16).'...' ?></a></p>
                    <?php else : ?>
                        <p class="pl-2"><a style="color: black" href="perfil-usuario.php?id_sus=<?= $suscripcion['id_suscrito'] ?>"><?= $suscripcion['nombre'].' '.$suscripcion['apellidos'] ?></a></p>
                    <?php endif; ?>
                </div>
            </div>
                                
            <?php endforeach ?>
        <?php endif; ?>
        </div>

    <?php else : ?>

        <form class="d-none d-lg-block" action="inc/models/login.php" method="POST">
        
            <h5 class="mt-4 mb-3 font-weight-bold" style="font-size: 20px">Iniciar Sesión</i></h5>
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" name="email" class="form-control rounded-0" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email">
            </div>
            <div class="form-group">
                    <label for="exampleInputPassword1">Contraseña</label>
                    <input type="password" name="pass" class="form-control rounded-0" id="exampleInputPassword1" placeholder="Contraseña">
            </div>
            <a class="text-decoration-none" href="" data-toggle="modal" data-target="#passModal">
                He olvidado mi contraseña.
            </a>
            <button class="mt-2" type="submit" style="padding: 5px; border: 1px solid black; background: white; width: 100%">Iniciar Sesión</button>
            <p style="padding: 5px; border: 1px solid black;" class="text-center mt-2"><a href="./registro.php" style="text-decoration: none; color: black">Registrarse</a></p>
        </form>

        <!-- Modal Recuperar Pass -->
        <div class="modal fade" id="passModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form action="inc/models/restablecer_pass.php" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Recuperar contraseña</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Por favor, introduzca su correo electrónico y se le enviará un enlace para recuperar su contraseña.</p>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Correo electrónico: </label>
                                    <input type="email" class="form-control rounded-0" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Introduzca su email" required>
                                    <small id="emailHelp" class="form-text text-muted">No compartas tu correo con nadie.</small>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn botones rounded-0">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <?php endif ; ?>

        


    <!-- <a href="index.php" class="btn btn-outline-success w-100 rounded-0 mt-2">Cerrar Sesión</a> -->


</div>
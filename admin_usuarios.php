<?php session_start(); ?>
<?php
    require 'inc/functions/funciones.php';
?>
<?php $totalUsuarios = getTotalUsuarios() ?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Konema | Plataforma de vídeos</title>
	<!-- <link rel="stylesheet" type="text/css" href="./css/styles.css"> -->
	<link rel="stylesheet" href="//stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="//fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
	<link rel="icon" href="./images/favicon.ico">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<style>
        .navFondo{
			background: linear-gradient(to right, rgba(43,191,137,1) 0%, rgba(29,149,103,1) 85%, rgba(29,149,103,1) 100%);;
			border-bottom: 6px solid white;
		}
		.logo{
			width: 130px; 
			height: 35px;
		}
		.negro{
			color: #2b2b2b !important;
		}
		.blanco{
			color: white !important;
		}
        /* .buscador{
			width: 500px !important;
		} */
		.botones{
			background: #2abf88;
			color: white;
		}
        .fondo{
            background: #000000;
            color: white;
        }
        .enlacesFooter{
			text-decoration: none;
			color: white;
		}
		.enlacesFooter:hover{
			text-decoration: none;
			color: #2abf88;
		}
        .iconos{
			background: linear-gradient(to right, rgba(43,191,137,1) 0%, rgba(29,149,103,1) 85%, rgba(29,149,103,1) 100%);
			color: white;
		}
        .main-color-bg{
            background: #24af7a !important;
            color: white !important;
            border-color: #1a895e !important;
        }
        .items-color{
            color: #000000 !important;
        }
        .items-color:hover{
            background: #F7F7F7;
        }
        .table-hover-personalizado tr:hover:not(:first-child):not(:last-child){
            background: #000000;
            color: white !important;
        }

        /* RESPONSIVE TABLA */

        @media screen and (max-width: 767px){

            .tablaUsuarios td{
                width: 100%;
                display: flex;
                align-items:center;
            }
            .tablaUsuarios tr th{
                display:none;
            }
            .tablaUsuarios td:before{
                width: 50%;
            }
            .tablaUsuarios td:first-of-type{
                border-top: 1px solid;
            }
            .tablaUsuarios td:last-of-type{
                border-bottom: 1px solid;
            }



            .tablaUsuarios td:nth-of-type(1)::before{
                content: "NOMBRE ";
                font-weight: bold;
            }
            .tablaUsuarios td:nth-of-type(2)::before{
                content: "EMAIL ";
                font-weight: bold;
            }
            .tablaUsuarios td:nth-of-type(3)::before{
                content: "FECHA DE REGISTRO ";
                font-weight: bold;
            }
            .tablaUsuarios td:nth-of-type(4)::before{
                content: "EDITAR ";
                font-weight: bold;
                color: black;
            }
            .tablaUsuarios td:nth-of-type(5)::before{
                content: "BORRAR ";
                font-weight: bold;
                color: black;
            }

            .table-hover-personalizado tr:hover:not(:first-child):not(:last-child){
                background: #f7f7f7;
                color: black !important;
            }

            .total-usuarios::before{
                content: "" !important;
            }

        }
	</style>
</head>
<body>

<?php if (!isset($_SESSION['admin'])) : ?>
    <?php header('Location: index.php'); ?>
<?php else: ?>

    <header class="sticky-top py-1 navFondo">
		<nav class="navbar navbar-expand-lg navbar-light py-2 pl-lg-5 pr-lg-5">
            <a class="navbar-brand" href="panel_administrador.php">
                <img src="images/logo2.png" class="logo">
            </a>
            
            <li class="ml-auto nav-item dropdown list-unstyled d-flex align-items-center">
				<img class="rounded-circle mr-2" style="width: 30px; height: 30px" src="images/admin1.jpg" data-toggle="tooltip" data-placement="top" title="Administrador">
				<a class="text-decoration-none blanco" href="./inc/models/cerrar_sesion.php" style="font-size: 24px"><i class="fa fa-sign-out"></i></a>
			</li>

		</nav>
	</header>

    <div class="container-fluid fondo py-2">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-6">
                <h5>PANEL DE ADMINISTRACIÓN</h5>
                </div>
                    <div class="col-6 text-right">
                        <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle rounded-0 font-weight-bold" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            CREAR
                        </button>
                        <div class="dropdown-menu rounded-0" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Vídeo</a>
                            <a class="dropdown-item" href="#">Usuario</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-3">
        <div class="row">

            <div class="col-12">
                <div class="form-group">
                    <input type="text" name="busqueda" id="busqueda" class="form-control rounded-0 buscador" placeholder="Buscar">
                </div>
            </div>
            <div class="col-12">
                <div class="card rounded-0 mt-3">
                    <div class="card-header font-weight-bold rounded-0">
                        USUARIOS
                    </div>

                    <div class="card-body" id="tabla_resultado">
                        
                    </div>
                </div>
            </div>


        </div>
    </div>





    <!--FOOTER  -->

    <div class="container-fluid p-4 d-flex justify-content-center iconos" style="font-size: 36px">
        <i class="fa fa-instagram mr-5"></i>
        <i class="fa fa-twitter mr-5"></i>
        <i class="fa fa-facebook"></i>
    </div>
    <footer class="container-fluid row ml-0" style="background: black; color: white;">
        <div class="col-lg-6 ml-0 pt-5 pb-3 py-lg-5 text-lg-left text-center">
            <h5>KONEMA</h5>
            <p class="mb-0"><a href="" class="enlacesFooter">Política de privacidad</a> | <a href="" class="enlacesFooter">Términos y condiciones de uso</a></p>
            <p class="mb-0"><a href="" class="enlacesFooter">Derechos de privacidad de España</a></p>
            <p class="mb-0">&copy; 2020 Konema Entertainment</p>
        </div>
        <div class="col-lg-6 ml-0 pb-5 py-lg-5 align-items-lg-end align-items-center d-flex flex-column">
            <div>
                <div class="d-flex justify-content-center justify-content-lg-end mb-2">
                    <img src="images/k.jpg" width="50">
                    <img src="images/k1.jpg" width="50">
                </div>
                
                <p class="font-weight-light mb-0 text-lg-right text-center">Desarrollado por <span class="font-weight-bold">José María Bernal</span></p>
                <p class="font-weight-light mb-0 text-lg-right text-center">2º DAW <span class="font-weight-bold">Proyecto Integrado</span></p>
            </div>
        </div>
    </footer>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>

    <script>
        $(obtener_registros());

        function obtener_registros(usuarios)
        {
            $.ajax({
                url : 'inc/models/consultas_usuarios.php',
                type : 'POST',
                dataType : 'html',
                data : { usuarios: usuarios },
                })

            .done(function(resultado){
                $("#tabla_resultado").html(resultado);
            })
        }

        $(document).on('keyup', '#busqueda', function()
        {
            var valorBusqueda=$(this).val();
            if (valorBusqueda!="")
            {
                obtener_registros(valorBusqueda);
            }
            else
                {
                    obtener_registros();
                }
        });

    </script>

<?php endif; ?>

</body>
</html>
<?php
    require '../functions/conn.php';
    if (!isset($_SESSION['admin'])) :
        header('Location: ../../index.php');
    else:

        $tabla = "";
        $query = "SELECT * FROM usuarios ORDER BY fecha_registro DESC";

        if(isset($_POST['usuarios'])){
            $q = $db->real_escape_string($_POST['usuarios']);
            $query = "SELECT * FROM usuarios WHERE 
            nombre COLLATE UTF8_GENERAL_CI  LIKE '%".$q."%' OR
            apellidos COLLATE UTF8_GENERAL_CI  LIKE '%".$q."%' OR
            email COLLATE UTF8_GENERAL_CI  LIKE '%".$q."%'";
        }

        $queryUsuarios = mysqli_query($db,$query);
        if (mysqli_num_rows($queryUsuarios) > 0)

        {
            $tabla.= 
            '<table class="table table-hover-personalizado tablaUsuarios bg-light text-md-center mb-0">
                <tr class="card-header">
                    <th>NOMBRE</th>
                    <th>APELLIDOS</th>
                    <th>EMAIL</th>
                    <th>EDITAR</th>
                    <th>BORRAR</th>
                </tr>';

            while($filaUsuarios= $queryUsuarios->fetch_assoc())
            {

                $tabla.=
                '<tr>    
                    <td>'.$filaUsuarios['nombre'].'</td>
                    <td>'.$filaUsuarios['apellidos'].'</td>
                    <td>'.$filaUsuarios['email'].'</td>
                    <td class="text-primary"><i class="fa fa-pencil"></i></td>
                    <td><i class="fa fa-remove text-danger"></i></td>
                </tr>
                ';
            }

            $tabla.='<tr>    
                        <td colspan="5" class="text-right font-weight-bold card-header total-videos">TOTAL DE USUARIOS: '.mysqli_num_rows($queryUsuarios).'</td>
                    </tr>
                </table>';
        } else
            {
                $tabla="No se encontraron coincidencias con sus criterios de búsqueda.";
            }


        echo $tabla;


endif;

?>
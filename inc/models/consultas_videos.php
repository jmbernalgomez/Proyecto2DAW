<?php 

    require '../functions/conn.php';
    if (!isset($_SESSION['admin'])) :
		header('Location: ../../index.php');
    else:

        $tabla = "";
        $query = "SELECT * FROM entradas ORDER BY fecha_subida DESC";

        if(isset($_POST['videos'])){
            $q = $db->real_escape_string($_POST['videos']);
            $query = "SELECT * FROM entradas WHERE 
            titulo COLLATE UTF8_GENERAL_CI  LIKE '%".$q."%' OR
            descripcion COLLATE UTF8_GENERAL_CI  LIKE '%".$q."%' OR
            categoria COLLATE UTF8_GENERAL_CI  LIKE '%".$q."%'";
        }

        $queryVideos = mysqli_query($db,$query);
        if (mysqli_num_rows($queryVideos) > 0)

        {
            $tabla.= 
            '<table class="table table-hover-personalizado tablaUsuarios bg-light text-md-center mb-0">
                <tr class="card-header">
                    <th>TÍTULO</th>
                    <th>RECOMENDACIÓN</th>
                    <th>FECHA DE SUBIDA</th>
                    <th>EDITAR</th>
                    <th>BORRAR</th>
                </tr>';

            while($filaVideos= $queryVideos->fetch_assoc())
            {

                if(strlen($filaVideos['titulo']) > 20){
                    $titulo = substr($filaVideos['titulo'], 0,15).'...';
                }
                else{
                    $titulo = $filaVideos['titulo'];
                }

                $tabla.=
                '<tr>    
                    <td data-toggle="tooltip" data-placement="top" title="'.$filaVideos['titulo'].'">'.$titulo.'</td>
                    <td>+'.$filaVideos['recomendacion'].'</td>
                    <td>'.$filaVideos['fecha_subida'].'</td>
                    <td class="text-primary"><i class="fa fa-pencil"></i></td>
                    <td><i class="fa fa-remove text-danger"></i></td>
                </tr>
                ';
            }

            $tabla.='<tr>    
                        <td colspan="5" class="text-right font-weight-bold card-header total-videos">TOTAL DE VIDEOS: '.mysqli_num_rows($queryVideos).'</td>
                    </tr>
                </table>';
        } else
            {
                $tabla="No se encontraron coincidencias con sus criterios de búsqueda.";
            }


        echo $tabla;


    endif;
?>
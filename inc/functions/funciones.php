<?php

	function getMisVideos(){
		require 'conn.php';
		$id_usuario = $_SESSION['user']['id'];
		$sql = "SELECT * FROM entradas WHERE id_usuario = $id_usuario";
		$query = mysqli_query($db,$sql);
		return $query;
	}

	function getMisVideos1($id){
		require 'conn.php';
		$sql = "SELECT * FROM entradas WHERE id_usuario = $id";
		$query = mysqli_query($db,$sql);
		return $query;
	}

	function getUsuario($id){
		require 'conn.php';
		$sql = "SELECT * FROM usuarios WHERE id = $id";
		$query = mysqli_query($db,$sql);
		return $query;
	}

	function getEntrada($id){ 
		require 'conn.php';
		$sql = "SELECT `entradas`.*, `usuarios`.*, `entradas`.`id` as `id_entrada`, `entradas`.`id_usuario` as iduser, `suscripciones`.`id` as scuenta
				FROM `entradas` LEFT JOIN `usuarios` 
				ON `usuarios`.`id` = `entradas`.`id_usuario`
				LEFT JOIN `suscripciones`
				ON `suscripciones`.`id_suscrito` = `entradas`.`id_usuario`
				WHERE `entradas`.`id` = $id";
		$query = mysqli_query($db,$sql);
		return $query;
	}

	function getCuentaSuscripciones($id){
		require 'conn.php';
		$video = getEntrada($id);
		$video = $video->fetch_assoc();
		$id_usuario = $video['iduser'];
		$sql = "SELECT count(id_usuario) as cuenta
				FROM suscripciones
				WHERE id_suscrito = $id_usuario";
		$query = mysqli_query($db,$sql);
		return $query;
	}

	function getCuentaSuscripcionesCanal($id){
		require 'conn.php';
		$id_usuario = $id;
		$sql = "SELECT count(id_usuario) as cuenta
				FROM suscripciones
				WHERE id_suscrito = $id_usuario";
		$query = mysqli_query($db,$sql);
		return $query;
	}

	function getCuentaVideosCanal($id){
		require 'conn.php';
		$id_usuario = $id;
		$sql = "SELECT count(id_usuario) as cuenta
				FROM entradas
				WHERE id_usuario = $id_usuario";
		$query = mysqli_query($db,$sql);
		return $query;
	}

	function getVideosALL($busqueda){
		require 'conn.php';
		$sql = "SELECT *, count(id) as cuentaTotal
				FROM entradas
				WHERE titulo COLLATE UTF8_GENERAL_CI 
				LIKE '%$busqueda%' 
				OR descripcion COLLATE UTF8_GENERAL_CI LIKE '%$busqueda%' 
				OR tags COLLATE UTF8_GENERAL_CI LIKE '%$busqueda%'";
		$query = mysqli_query($db,$sql);
		return $query;	
	}

	function getCanalesALL($busqueda){
		require 'conn.php';
		$sql = "SELECT *, count(id) as cuentaTotal
				FROM usuarios
				WHERE nombre COLLATE UTF8_GENERAL_CI 
				LIKE '%$busqueda%' 
				OR apellidos COLLATE UTF8_GENERAL_CI LIKE '%$busqueda%'";
		$query = mysqli_query($db,$sql);
		return $query;	
	}

	function getVideosCanales($busqueda){
		require 'conn.php';
		$usuarios = getCanalesALL($busqueda);
		$usuarios = $usuarios->fetch_assoc();
		$id_usuario = $usuarios['id'];
		$sql = "SELECT *
				FROM entradas
				WHERE id_usuario =  $id_usuario LIMIT 2";
		$query = mysqli_query($db,$sql);
		return $query;
	}


	function getVideosBL(){ //BARRA LATERAL ÚLTIMOS VIDEOS
		require 'conn.php';
		$sql = "SELECT `entradas`.*, `usuarios`.*, `entradas`.`id` as `id_entrada`
				FROM `entradas` LEFT JOIN `usuarios` 
				ON `usuarios`.`id` = `entradas`.`id_usuario`
				ORDER BY rand() LIMIT 10";
		$query = mysqli_query($db,$sql);
		return $query;
	}

	function getVideosGeneral(){ //CATEGORIA GENERAL
		require 'conn.php';
		$sql = "SELECT `entradas`.*, `usuarios`.*, `entradas`.`id` as `id_entrada`
				FROM `usuarios` 
				LEFT JOIN `entradas`
				ON `usuarios`.`id` = `entradas`.`id_usuario`
				WHERE categoria = 'general' ORDER BY fecha_subida DESC LIMIT 5";
		$query = mysqli_query($db,$sql);
		return $query;
	}

	function getVideosMusica(){ //CATEGORIA MÚSICA
		require 'conn.php';
		$sql = "SELECT `entradas`.*, `usuarios`.*, `entradas`.`id` as `id_entrada`
				FROM `usuarios` 
				LEFT JOIN `entradas`
				ON `usuarios`.`id` = `entradas`.`id_usuario`
				WHERE categoria = 'musica' ORDER BY fecha_subida DESC LIMIT 5";
		$query = mysqli_query($db,$sql);
		return $query;
	}

	function getVideosDeportes(){ //CATEGORIA DEPORTES
		require 'conn.php';
		$sql = "SELECT `entradas`.*, `usuarios`.*, `entradas`.`id` as `id_entrada`
				FROM `usuarios` 
				LEFT JOIN `entradas`
				ON `usuarios`.`id` = `entradas`.`id_usuario`
				WHERE categoria = 'deportes' ORDER BY fecha_subida DESC LIMIT 5";
		$query = mysqli_query($db,$sql);
		return $query;
	}

	function getVideosVideojuegos(){ //CATEGORIA VIDEOJUEGOS
		require 'conn.php';
		$sql = "SELECT `entradas`.*, `usuarios`.*, `entradas`.`id` as `id_entrada`
				FROM `usuarios` 
				LEFT JOIN `entradas`
				ON `usuarios`.`id` = `entradas`.`id_usuario`
				WHERE categoria = 'videojuegos' ORDER BY fecha_subida DESC LIMIT 5";
		$query = mysqli_query($db,$sql);
		return $query;
	}

	function getLikes($id){
		require 'conn.php';
		$sql = "SELECT count(id) as likes, id, id_usuario, id_entrada FROM likes WHERE id_entrada = $id";
		$query = mysqli_query($db,$sql);
		return $query;
	}

	function getLike($id){
		require 'conn.php';
		$id_usuario = $_SESSION['user']['id'];
		$sql = "SELECT count(id) as likes, id, id_usuario, id_entrada FROM likes WHERE id_entrada = $id AND id_usuario = $id_usuario";
		$query = mysqli_query($db,$sql);
		return $query;
	}

	function getFavoritos(){
		require 'conn.php';
		$id_usuario = $_SESSION['user']['id'];
		$sql = "SELECT `likes`.*, `entradas`.*, `entradas`.`id` as `id_entrada`, `usuarios`.*
				FROM `likes`
				LEFT JOIN `entradas` ON `likes`.`id_entrada` = `entradas`.`id`
				LEFT JOIN `usuarios` ON `entradas`.`id_usuario` = `usuarios`.`id`
				WHERE `likes`.`id_usuario` = $id_usuario";
		$query = mysqli_query($db,$sql);
		return $query;
	}

	function getComentarios($id){
		require 'conn.php';
		$sql = "SELECT `comentarios`.*, `comentarios`.`id` as `id_comentario`, `usuarios`.*
				FROM `comentarios`
				LEFT JOIN `usuarios` 
				ON `comentarios`.`id_usuario` = `usuarios`.`id`
				WHERE `comentarios`.`id_entrada` = $id
				ORDER BY `comentarios`.`id` DESC";
		$query = mysqli_query($db,$sql);
		return $query;
	}

	function getComentariosRespuestas($id){
		require 'conn.php';
		$sql = "SELECT `respuestas_comentarios`.*, `usuarios`.*
				FROM `respuestas_comentarios`
				LEFT JOIN `usuarios` 
				ON `respuestas_comentarios`.`id_usuario` = `usuarios`.`id`
				WHERE `respuestas_comentarios`.`id_comentario` = $id
				ORDER BY `respuestas_comentarios`.`id` DESC";
		$query = mysqli_query($db,$sql);
		return $query;
	}

	function getCuentaComentarios($id){
		require 'conn.php';
		$sql = "SELECT count(id) as cuenta FROM comentarios WHERE id_entrada = $id";
		$query = mysqli_query($db,$sql);
		return $query;
	}

	function getSuscripcionesCuenta($id){
		require 'conn.php';
		$sql = "SELECT count(id) as suscripciones, id, id_suscrito, id_usuario FROM suscripciones WHERE id_entrada = $id";
		$query = mysqli_query($db,$sql);
		return $query;
	}

	function getSuscripcion($id_suscrito){
		require 'conn.php';
		if (isset($_SESSION['user'])) {
			$id_usuario = $_SESSION['user']['id'];
			$sql = "SELECT `suscripciones`.*, `usuarios`.*, `suscripciones`.`id` as `id_suscripciones`
					FROM `suscripciones`
					LEFT JOIN `usuarios` ON `suscripciones`.`id_suscrito` = `usuarios`.`id`
					WHERE `suscripciones`.`id_usuario` = $id_usuario AND `suscripciones`.`id_suscrito` = $id_suscrito";
			$query = mysqli_query($db,$sql);
			return $query;
		}
		
	}

	function getSuscripciones(){
		require 'conn.php';
		$id_usuario = $_SESSION['user']['id'];
		$sql = "SELECT `suscripciones`.*, `usuarios`.*, `suscripciones`.`id` as `id_suscripciones`
				FROM `suscripciones`
				LEFT JOIN `usuarios` 
				ON `suscripciones`.`id_suscrito` = `usuarios`.`id`
				WHERE `suscripciones`.`id_usuario` = $id_usuario
				ORDER BY `usuarios`.`nombre` ASC";
		$query = mysqli_query($db,$sql);
		return $query;
	}

	function getPortada(){
		require 'conn.php';
		$id_usuario = $_SESSION['user']['id'];
		$sql = "SELECT imagen_portada FROM usuarios WHERE id = $id_usuario";
		$query = mysqli_query($db, $sql);
		$rows = mysqli_fetch_array($query);
		$imagen = $rows[0];
		return $imagen;
	}

	function getPortada1($id){
		require 'conn.php';
		$sql = "SELECT imagen_portada FROM usuarios WHERE id = $id";
		$query = mysqli_query($db, $sql);
		$rows = mysqli_fetch_array($query);
		$imagen = $rows[0];
		return $imagen;
	}

	function getPerfil(){
		require 'conn.php';
		$id_usuario = $_SESSION['user']['id'];
		$sql = "SELECT imagen_perfil FROM usuarios WHERE id = $id_usuario";
		$query = mysqli_query($db, $sql);
		$rows = mysqli_fetch_array($query);
		$imagenPerfil = $rows[0];
		return $imagenPerfil;
	}

	function getPerfil1($id){
		require 'conn.php';
		$sql = "SELECT imagen_perfil FROM usuarios WHERE id = $id";
		$query = mysqli_query($db, $sql);
		$rows = mysqli_fetch_array($query);
		$imagenPerfil = $rows[0];
		return $imagenPerfil;
	}

	function getRCreador($id){
		require 'conn.php';
		$sql = "SELECT recomendacion FROM entradas WHERE id = $id";
		$query = mysqli_query($db, $sql);
		$rows = mysqli_fetch_array($query);
		$recomendacion = $rows[0];
		return $recomendacion;
	}

	function getRVisitante($id){
		require 'conn.php';
		$sql = "SELECT ROUND(AVG(recomendacion)) FROM recomendaciones_visitantes WHERE id_entrada = $id";
		$query = mysqli_query($db, $sql);
		$rows = mysqli_fetch_array($query);
		$recomendacion = $rows[0];
		return $recomendacion;
	}

	function getRAdministrador($id){
		require 'conn.php';
		$sql = "SELECT recomendacion_admin FROM entradas WHERE id = $id";
		$query = mysqli_query($db, $sql);
		$rows = mysqli_fetch_array($query);
		$recomendacion = $rows[0];
		return $recomendacion;
	}


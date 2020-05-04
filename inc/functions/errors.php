<?php

	function alerta($errors, $campo){
		$alert = '';
		if (isset($errors[$campo]) && !empty($campo)) {
			return "<div class='mt-2 alert alert-danger rounded-0'>".$errors[$campo]."</div>";
		}

		return $alert;
	}

	function borrarAlertas(){
		if (isset($_SESSION['errors'])) {
			session_destroy();
		}
		if (isset($_SESSION['success'])) {
			session_destroy();
		}
		if (isset($_SESSION['error_login'])) {
			session_destroy();
		}
	}
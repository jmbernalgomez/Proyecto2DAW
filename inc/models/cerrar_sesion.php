<?php

	session_start();
	if (isset($_SESSION['user'])) {
		session_destroy();
	}
	if (isset($_SESSION['admin'])) {
		session_destroy();
	}
	if (isset($_SESSION['restriccion'])) {
		session_destroy();
	}

	header("Location: ../../index.php");
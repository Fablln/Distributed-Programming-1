<?php
require_once 'skeleton.php';
if (!isset($_SESSION['user'])) {
		header('Location: index.php');
		exit;
	} else {
		session_regenerate_id(true);
		session_unset();
		session_destroy();
		header('Location: index.php?msg=loggedOut');
		exit;
}
?>

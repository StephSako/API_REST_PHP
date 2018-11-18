<?php
	include(realpath('../rest.php'));
	include(realpath('../objects/utilisateur.php'));

	$idUser = intval(htmlspecialchars($_POST["idUser"]));
	$idUserDeleted = intval(htmlspecialchars($_POST["idUserDeleted"]));

	$user = new Utilisateur($idUser);
	$message = $user->delete_contact($idUserDeleted);
	
	retour_json_message($message);
?>
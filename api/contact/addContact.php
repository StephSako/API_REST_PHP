<?php
	include(realpath('../rest.php'));
	include(realpath('../objects/utilisateur.php'));

	$idUser = intval(htmlspecialchars($_POST["idUser"]));
	$idUserAdded = intval(htmlspecialchars($_POST["idUserAdded"]));

	$user = new Utilisateur($idUser);
	$message = $user->add_contact($idUserAdded);
	
	retour_json_message($message);
?>
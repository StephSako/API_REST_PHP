<?php
	include(realpath('../rest.php'));
	include(realpath('../objects/utilisateur.php'));

	$idUser = intval(htmlspecialchars($_POST["idUser"]));
	$nomEvent = htmlspecialchars($_POST["nomEvent"]);

	$user = new Utilisateur($idUser);
	$message = $user->participateEvent($nomEvent);

	retour_json_message($message);
?>
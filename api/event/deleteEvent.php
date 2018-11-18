<?php
	include(realpath('../rest.php'));
	include(realpath('../objects/evenement.php'));

	//récupération des informations du formulaire de création de l'évènement
	$nomEvent = htmlspecialchars($_POST["nomEvent"]);
	$idCreateur = intval(htmlspecialchars($_POST["idCreateur"]));

	$event = new Evenement($nomEvent);
	$message = $event->delete_event($idCreateur);

	retour_json_message($message);
?>
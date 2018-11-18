<?php
	include(realpath('../rest.php'));
	include(realpath('../objects/evenement.php'));

	//récupération des informations du formulaire de création de l'évènement
	$capaciteEvent = intval(htmlspecialchars($_POST["capacite"]));
	$heure = $_POST["heure"];
	$dateEvent = $_POST["date"];
	$NumUtilisateur = intval(htmlspecialchars($_POST["NumUtilisateur"]));
	$latitude = doubleval(htmlspecialchars($_POST["latitude"]));
	$longitude = doubleval(htmlspecialchars($_POST["longitude"]));
	$commentaireLieu = htmlspecialchars($_POST["commentaireLieu"]);
	$nomTypeEvenement = htmlspecialchars($_POST["nomTypeEvenement"]);
	$nomEvenement = htmlspecialchars($_POST["nomEvenement"]);

	$event = new Evenement($capaciteEvent,$heure,$dateEvent,$NumUtilisateur,$latitude,$longitude,$commentaireLieu,$nomTypeEvenement,$nomEvenement);
	$message = $event->add_event();

	retour_json_message($message);
?>
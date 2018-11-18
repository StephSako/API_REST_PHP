<?php
	include(realpath('../rest.php'));
	include(realpath('../objects/utilisateur.php'));

	$idUser = intval(htmlspecialchars($_POST["idUser"]));
	$latitude = doubleval(htmlspecialchars($_POST["latitude"]));
	$longitude = doubleval(htmlspecialchars($_POST["longitude"]));

	//création de l'utilisateur souhaitant se connecter
	$Utilisateur = new Utilisateur($idUser);

	if($idUser != null && $latitude != null && $longitude != null){
		$message = $Utilisateur->updateLoc($latitude, $longitude);
		retour_json_message($message);
	}
	else retour_json_message("Vos informations sont incomplètes.");
?>
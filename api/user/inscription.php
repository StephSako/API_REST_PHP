<?php
	include(realpath('../rest.php'));
	include(realpath('../objects/utilisateur.php'));
	
	//récupération des informations du formulaire de connexion
	$mail = htmlspecialchars(trim($_POST["mail"]));
	$mdpasse = htmlspecialchars(trim($_POST["mdpasse"]));
	$pseudo = htmlspecialchars(trim($_POST["pseudo"]));
	$commentaire = htmlspecialchars(trim($_POST["commentaire"]));
	$latitude = doubleval(htmlspecialchars($_POST["latitude"]));
	$longitude = doubleval(htmlspecialchars($_POST["longitude"]));

	//création de l'utilisateur souhaitant s'inscrire
	$Utilisateur = new Utilisateur($mail, $mdpasse, $pseudo, $commentaire, $latitude, $longitude);

	if($mail != null && $mdpasse != null && $pseudo != null && preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,3}$#i', $mail)){
		$id = $Utilisateur->inscription();

		if($id != -1) retour_json_sign_in_up($id, "Vous êtes inscrit.", true);
		else retour_json_sign_in_up($id, "Les informations sont incorrectes.", false);
	}
	else retour_json_sign_in_up(null, "Les informations sont incomplètes.", false);
?>
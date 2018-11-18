<?php
	include(realpath('../rest.php'));
	include(realpath('../objects/utilisateur.php'));

	$mail = htmlspecialchars(trim($_POST["mail"]));
	$mdpasse = htmlspecialchars(trim($_POST["mdpasse"]));

	//création de l'utilisateur souhaitant se connecter
	$Utilisateur = new Utilisateur($mail, $mdpasse);

	if($mail != null && $mdpasse != null && preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,3}$#i', $mail)){
		$id = $Utilisateur->connexion();

		if($id != -1) retour_json_sign_in_up($id, "Vous êtes connecté.", true);
		else retour_json_sign_in_up($id, "Les informations sont incorrectes.", false);
	}
	else retour_json_sign_in_up(null, "Les informations sont incomplètes.", false);

?>
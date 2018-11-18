<?php
	include(realpath('../rest.php'));
	include(realpath('../objects/utilisateur.php'));

	$idUser = intval(htmlspecialchars($_POST["idUser"]));
	$idFriend = intval(htmlspecialchars($_POST["idFriend"]));

	$user = new Utilisateur($idUser);
	$val = $user->estAmi($idFriend);
	
	retour_json_message($val);
?>
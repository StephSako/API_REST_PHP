<?php
	include(realpath('../rest.php'));
	include(realpath('../config/bdd.php'));

	//récupération des informations du formulaire de création de l'évènement
	$nomUser = $_POST["pseudo"];

	//recherche des contacts
    $resultUserFriend = $co->prepare("SELECT Pseudo, NumUtilisateur_1 AS User, EAD.NumUtilisateur AS NumUtilisateur
    	FROM Utilisateur U, est_ami_de EAD
		WHERE (EAD.NumUtilisateur = '".$nomUser."'
		AND EAD.NumUtilisateur_1 = U.NumUtilisateur)
		OR (EAD.NumUtilisateur_1 = '".$nomUser."'
		AND EAD.NumUtilisateur = U.NumUtilisateur)");
    $resultUserFriend->execute();

    //recherche des contacts
    $resultUserFriendLoc = $co->prepare("SELECT latitude, longitude FROM Utilisateur U,
    	est_ami_de EAD, Localisation L
		WHERE (EAD.NumUtilisateur = '".$nomUser."'
		AND EAD.NumUtilisateur_1 = U.NumUtilisateur
        AND U.IdLocalisation = L.IdLocalisation)
		OR (EAD.NumUtilisateur_1 = '".$nomUser."'
		AND EAD.NumUtilisateur = U.NumUtilisateur
		AND U.IdLocalisation = L.IdLocalisation)");
    $resultUserFriendLoc->execute();

    $tabIDsFriends = $resultUserFriend->fetchAll(PDO::FETCH_ASSOC);
    $tabIDsFriendsLoc = $resultUserFriendLoc->fetchAll(PDO::FETCH_ASSOC);

    for ($i = 0; $i <= count($tabIDsFriends)-1; $i++){
		$tabIDsFriends[$i]['Localisation']['longitude'] = $tabIDsFriendsLoc[$i]["longitude"];
		$tabIDsFriends[$i]['Localisation']['latitude'] = $tabIDsFriendsLoc[$i]["latitude"];
	}

	for ($i = 0; $i <= count($tabIDsFriends)-1; $i++){
		if($tabIDsFriends[$i]['NumUtilisateur'] == $nomUser){
			$tabIDsFriends[$i]['NumUtilisateur'] = $tabIDsFriends[$i]['User'];
			$tabIDsFriends[$i]['User'] = $nomUser;
		}
	}

	retour_json_sign_list_contact($nomUser, $tabIDsFriends, "Liste envoyée", true);
?>
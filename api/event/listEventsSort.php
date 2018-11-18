<?php
	include(realpath('../rest.php'));
	include(realpath('../config/bdd.php'));

	//afficher tous les évènements sur la map

	//requête ppur récupérer les évènements des organisateurs des JO
	$resultEventJO = $co->prepare("SELECT NomTypeEvenement, NumEvenementJO AS NumEvenement, DateEvenementJO AS DateEvenement, HeureEvenementJO AS HeureEvenement, NomEvenementJO AS NomEvenement FROM EvenementJO E, TypeEvenement TE
		WHERE NumTypeEvenementJO = TE.NumTypeEvenement");

	//requête ppur récupérer les localisations des évènements des organisateurs des JO
	$resultEventJOLoc = $co->prepare("SELECT NumEvenementJO AS NumEvenement, latitude, longitude FROM EvenementJO E, Localisation L
		WHERE E.IdLocalisationJO = L.IdLocalisation");

	//requête pour récupérer les évènements des Utilisateurs
	$resultEventUser = $co->prepare("SELECT NomTypeEvenement, NumEvenement, DateEvenement, NomTypeEvenement, HeureEvenement, CapaciteEvenement, Pseudo, NomEvenement FROM Utilisateur U, Evenement E,  TypeEvenement TE
		WHERE U.NumUtilisateur = E.NumUtilisateur
		AND E.NumTypeEvenement = TE.NumTypeEvenement");

	//requête pour récupérer les localisations des évènements des Utilisateurs
	$resultEventUserLoc = $co->prepare("SELECT latitude, longitude, NumEvenement FROM Evenement E, Localisation L
		WHERE E.IdLocalisation = L.IdLocalisation");

	$resultEventJO->execute();
	$resultEventUser->execute();
	$resultEventJOLoc->execute();
	$resultEventUserLoc->execute();
	
	$tabEventJOLoc = $resultEventJOLoc->fetchAll(PDO::FETCH_ASSOC);
	$tabEventUserLoc = $resultEventUserLoc->fetchAll(PDO::FETCH_ASSOC);
	$tabEventJO = $resultEventJO->fetchAll(PDO::FETCH_ASSOC);
	$tabEventUser = $resultEventUser->fetchAll(PDO::FETCH_ASSOC);

	for ($i = 0; $i <= count($tabEventUser)-1; $i++){
		$tabEventUser[$i]['Localisation']['longitude'] = $tabEventUserLoc[$i]["longitude"];
		$tabEventUser[$i]['Localisation']['latitude'] = $tabEventUserLoc[$i]["latitude"];
	}

	for ($i = 0; $i <= count($tabEventJO)-1; $i++){
		$tabEventJO[$i]['Localisation']['longitude'] = $tabEventJOLoc[$i]["longitude"];
		$tabEventJO[$i]['Localisation']['latitude'] = $tabEventJOLoc[$i]["latitude"];
	}

	retour_json_events_map($tabEventJO, $tabEventUser, "Tableaux des évènements transmis");
?>
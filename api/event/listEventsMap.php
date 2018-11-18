<?php
	include(realpath('../rest.php'));
	include(realpath('../config/bdd.php'));

	//afficher tous les évènements sur la map

	//requête pour récupérer les évènements des organisateurs des JO
	$resultEventJO = $co->prepare("SELECT NumEvenementJO, NomEvenementJO FROM EvenementJO");
	$resultEventJO->execute();

	//requête pour récupérer les localisation des évènements des organisateurs des JO
	$resultEventJOLoc = $co->prepare("SELECT latitude, longitude FROM EvenementJO, Localisation
		WHERE IdLocalisation = IdLocalisationJO");
	$resultEventJOLoc->execute();

	//requête pour récupérer les évènements des Utilisateurs
	$resultEventUser = $co->prepare("SELECT NumEvenement, NomEvenement FROM Evenement");
	$resultEventUser->execute();

	//requête pour récupérer les localisations des évènements des Utilisateurs
	$resultEventUserLoc = $co->prepare("SELECT latitude, longitude FROM Evenement E, Localisation L
		WHERE E.IdLocalisation = L.IdLocalisation");
	$resultEventUserLoc->execute();

	$tabEventJO = $resultEventJO->fetchAll(PDO::FETCH_ASSOC);
	$tabEventUser = $resultEventUser->fetchAll(PDO::FETCH_ASSOC);

	$tabEventJOLoc = $resultEventJOLoc->fetchAll(PDO::FETCH_ASSOC);
	$tabEventUserLoc = $resultEventUserLoc->fetchAll(PDO::FETCH_ASSOC);

	for ($i = 0; $i <= count($tabEventUser)-1; $i++){
		$tabEventUser[$i]['Localisation']['longitude'] = $tabEventUserLoc[$i]["longitude"];
		$tabEventUser[$i]['Localisation']['latitude'] = $tabEventUserLoc[$i]["latitude"];
	}

	for ($i = 0; $i <= count($tabEventJO)-1; $i++){
		$tabEventJO[$i]['LocalisationJO']['longitude'] = $tabEventJOLoc[$i]["longitude"];
		$tabEventJO[$i]['LocalisationJO']['latitude'] = $tabEventJOLoc[$i]["latitude"];
	}

	retour_json_events_map($tabEventJO, $tabEventUser, "Tableaux des évènements transmis");
?>
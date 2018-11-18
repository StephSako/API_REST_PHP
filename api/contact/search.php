<?php
	include(realpath('../rest.php'));
	include(realpath('../config/bdd.php'));

	$pieceOfUser = htmlspecialchars($_POST["pieceOfUser"]);

	//recherche du bout de pseudo dans les contacts
    $resultPOC = $co->prepare("SELECT Pseudo, NumUtilisateur FROM Utilisateur WHERE Pseudo LIKE '%".$pieceOfUser."%'");
    $resultPOC->execute();

    $resultPOCLoc = $co->prepare("SELECT latitude, longitude FROM Utilisateur NATURAL JOIN Localisation WHERE Pseudo LIKE '%".$pieceOfUser."%'");
    $resultPOCLoc->execute();

	$tabPOC = $resultPOC->fetchAll(PDO::FETCH_ASSOC);
	$tabPOCLoc = $resultPOCLoc->fetchAll(PDO::FETCH_ASSOC);

	for ($i = 0; $i <= count($tabPOC)-1; $i++){
		$tabPOC[$i]['Localisation']['longitude'] = $tabPOCLoc[$i]['longitude'];
		$tabPOC[$i]['Localisation']['latitude'] = $tabPOCLoc[$i]['latitude'];
	}

	retour_json_message($tabPOC);
?>
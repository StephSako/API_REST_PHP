<?php
	include(realpath('../rest.php'));
	include(realpath('../config/bdd.php'));

	$resultNomTypeEvenement = $co->prepare("SELECT NomTypeEvenement FROM TypeEvenement ORDER BY NomTypeEvenement");
    $resultNomTypeEvenement->execute();
    $tabNomTypeEvenement = $resultNomTypeEvenement->fetchAll(PDO::FETCH_COLUMN, 0);
	
	retour_json_message($tabNomTypeEvenement);
?>
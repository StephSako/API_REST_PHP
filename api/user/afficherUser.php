<?php
	include(realpath('../rest.php'));
	include(realpath('../config/bdd.php'));

	//récupération des informations du formulaire de création de l'évènement
	$idUser = $_POST["idUser"];
       
    //recherche des évènements auxquels participe l'utilisateur
    $resultUserPartEvent = $co->prepare("SELECT NomEvenement FROM Participe_a NATURAL JOIN Utilisateur
        WHERE NumUtilisateur = '".$idUser."'");
    $resultUserPartEvent->execute();

    $resultUserPseudo = $co->prepare("SELECT NumUtilisateur, Pseudo, Commentaire FROM Utilisateur
        WHERE NumUtilisateur = '".$idUser."'");
    $resultUserPseudo->execute();

    $resultUserLoc = $co->prepare("SELECT latitude, longitude FROM Utilisateur NATURAL JOIN Localisation
        WHERE NumUtilisateur = '".$idUser."'");
    $resultUserLoc->execute();

    $tabUserEvent = $resultUserPartEvent->fetchAll(PDO::FETCH_ASSOC);
    $tabUserUserPseudo = $resultUserPseudo->fetchAll(PDO::FETCH_ASSOC);
    $tabUserUserLoc = $resultUserLoc->fetchAll(PDO::FETCH_ASSOC);

    $tabUserUserPseudo[0]['Localisation'] = $tabUserUserLoc;
    $tabUserUserPseudo[0]['Participations'] = $tabUserEvent;

    retour_json_details_user($tabUserUserPseudo[0]['NumUtilisateur'], $tabUserUserPseudo[0]['Pseudo'], $tabUserUserPseudo[0]['Commentaire'],
        $tabUserUserPseudo[0]['Localisation'], $tabUserUserPseudo[0]['Participations']);
?>
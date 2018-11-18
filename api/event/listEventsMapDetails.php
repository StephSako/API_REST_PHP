<?php
    include(realpath('../rest.php'));
    include(realpath('../config/bdd.php'));

    $nomEvent = htmlspecialchars($_POST["nomEvent"]);

    //recherche de l'évènement USER
    $resultEventUSER = $co->prepare("SELECT NumEvenement FROM Evenement WHERE NomEvenement = '".$nomEvent."'");
    $resultEventUSER->execute();

    //... sinon de l'évènement JO
    $resultEventJO = $co->prepare("SELECT NumEvenementJO FROM EvenementJO WHERE NomEvenementJO = '".$nomEvent."'");
    $resultEventJO->execute();

    $tabUser = $resultEventUSER->fetchAll(PDO::FETCH_ASSOC);
    $tabJO = $resultEventJO->fetchAll(PDO::FETCH_ASSOC);

    if(count($tabUser) == 1){//lister l'évènement correspondant
    	$resultEvent = $co->prepare("SELECT E.NumEvenement, E.NomEvenement, NomTypeEvenement, DateEvenement, HeureEvenement, commentaireLieu FROM TypeEvenement NATURAL JOIN Evenement E NATURAL JOIN Localisation L
            WHERE NomEvenement = '".$nomEvent."'
            AND E.IdLocalisation = L.IdLocalisation");
    	$resultEvent->execute();

        //requête pour récupérer les participations à l'évènements des Utilisateurs
        $resultEventParticipate = $co->prepare("SELECT Pseudo, P.NumUtilisateur, P.NumEvenement FROM Utilisateur U, Participe_a P
            WHERE U.NumUtilisateur = P.NumUtilisateur
            AND P.NomEvenement = '".$nomEvent."'");
        $resultEventParticipate->execute();

        $resultEventLoc = $co->prepare("SELECT longitude, latitude FROM Evenement NATURAL JOIN Localisation L
            WHERE NomEvenement = '".$nomEvent."'");
        $resultEventLoc->execute();

        $tabEventLoc = $resultEventLoc->fetchAll(PDO::FETCH_ASSOC);
    	$tabEvent = $resultEvent->fetchAll(PDO::FETCH_ASSOC);
        $tabParticipateEvent = $resultEventParticipate->fetchAll(PDO::FETCH_ASSOC);

        $tabEvent[0]['Localisation'] = $tabEventLoc;

        retour_json_details_eventDetails($tabEvent[0]['NomEvenement'], $tabEvent[0]['NumEvenement'], $tabEvent[0]['NomTypeEvenement'], $tabEvent[0]['DateEvenement'], $tabEvent[0]['HeureEvenement'], $tabEvent[0]['commentaireLieu'], $tabEvent[0]['Localisation'], $tabParticipateEvent,"Détails de l'évènement USER transmis", true);
    }
    else if (count($tabJO) == 1){
        //lister l'évènement correspondant
        $resultEvent = $co->prepare("SELECT NumEvenementJO, NomEvenementJO, NomTypeEvenement, DateEvenementJO, HeureEvenementJO, commentaireLieu FROM TypeEvenement NATURAL JOIN EvenementJO E NATURAL JOIN  Localisation L
            WHERE NomEvenementJO = '".$nomEvent."'
            AND E.IdLocalisationJO = L.IdLocalisation");
        $resultEvent->execute();

        $resultEventLoc = $co->prepare("SELECT longitude, latitude FROM EvenementJO NATURAL JOIN Localisation L
            WHERE NomEvenementJO = '".$nomEvent."'");
        $resultEventLoc->execute();

        //requête pour récupérer les participations à l'évènements des Utilisateurs
        $resultEventParticipate = $co->prepare("SELECT Pseudo, P.NumUtilisateur, P.NumEvenementJO FROM Utilisateur U, Participe_a P
            WHERE U.NumUtilisateur = P.NumUtilisateur
            AND P.NomEvenementJO = '".$nomEvent."'");
        $resultEventParticipate->execute();

        $tabEventLoc = $resultEventLoc->fetchAll(PDO::FETCH_ASSOC);
        $tabEvent = $resultEvent->fetchAll(PDO::FETCH_ASSOC);
        $tabParticipateEvent = $resultEventParticipate->fetchAll(PDO::FETCH_ASSOC);

        $tabEvent[0]['Localisation'] = $tabEventLoc;

        retour_json_details_eventDetails($tabEvent[0]['NomEvenementJO'], $tabEvent[0]['NumEvenementJO'], $tabEvent[0]['NomTypeEvenement'], $tabEvent[0]['DateEvenementJO'], $tabEvent[0]['HeureEvenementJO'], $tabEvent[0]['commentaireLieu'], $tabEvent[0]['Localisation'], $tabParticipateEvent,"Détails de l'évènement JO transmis", true);
    }else{
        retour_json_details_eventDetails(null, null, null, null,"Il n'existe pas d'évènement à ce nom.", true);
    }
?>
<?php
	
	class Evenement{		
		private $idEvent;
		private $nomEvent;
		private $connexion;
		private $capaciteEvent;
		private $heure;
		private $dateEvent;
		private $NumUtilisateur;
		private $latitude;
		private $longitude;
		private $commentaireLieu;
		private $nomTypeEvenement;

		public function __construct(){
	    	include(realpath('../config/bdd.php'));
	    	$this->connexion = $co;

	    	//si un seul paramètre est passé
	    	if(func_num_args() == 1){
		    	//lorsque la valeur entrante est une string
		    	if(is_string(func_get_arg(0)))
					$this->nomEvent = func_get_arg(0);
				//lorsque la valeur entrante est une string
				else if(is_numeric(func_get_arg(0)))
		        	$this->idEvent = func_get_arg(0);
		    }
		    else if(func_num_args() == 2){
		    	//vérifier le premier paramètre
		    	if(is_string(func_get_arg(0)))
					$this->nomEvent = func_get_arg(0);
				//lorsque la valeur entrante est une string
				else if(is_numeric(func_get_arg(0)))
		        	$this->idEvent = func_get_arg(0);

		        //vérifier le deuxième paramètre
		    	if(is_string(func_get_arg(1)))
					$this->nomEvent = func_get_arg(1);
				//lorsque la valeur entrante est une string
				else if(is_numeric(func_get_arg(1)))
		        	$this->idEvent = func_get_arg(1);
		    }
		    else if(func_num_args() == 9){
		    	$this->capaciteEvent = func_get_arg(0);
		    	$this->heure = func_get_arg(1);
		    	$this->dateEvent = func_get_arg(2);
		    	$this->NumUtilisateur = func_get_arg(3);
		    	$this->latitude = func_get_arg(4);
		    	$this->longitude = func_get_arg(5);
		    	$this->commentaireLieu = func_get_arg(6);
		    	$this->nomTypeEvenement = func_get_arg(7);
		    	$this->nomEvent = func_get_arg(8);
		    }
	    }

	    public function delete_event($idCreateur){

	    	//vérifier si l'évènement existe
    		$verifExistence = $this->connexion->prepare("SELECT NumEvenement FROM Evenement WHERE NomEvenement = '".$this->nomEvent."'");
    		$verifExistence->execute();
    		$tabVerifExiste = $verifExistence->fetchAll(PDO::FETCH_ASSOC);

    		if(count($tabVerifExiste) == 1){//l'évènement existe bien

		    	//verification sur le personne qui supprime est le createur de l'évènement
	    		$verifCreateur = $this->connexion->prepare("SELECT NumEvenement, IdLocalisation FROM Evenement
	    			WHERE NumUtilisateur = '".$idCreateur."'
	    			AND NomEvenement = '".$this->nomEvent."'");
	    		$verifCreateur->execute();
	    		$tabVerifCreateur = $verifCreateur->fetchAll(PDO::FETCH_ASSOC);

	    		//récupération de la localisation
	    		$idLoc = $tabVerifCreateur[0]['IdLocalisation'];
	    		
	    		if(count($tabVerifCreateur) == 1){ //c'est bien le créateur

	    			//verification si l'évènement possède des participants
			    	$verifParticipants = $this->connexion->prepare("SELECT NumUtilisateur FROM Participe_a
			    		WHERE NomEvenement = '".$this->nomEvent."'");
		    		$verifParticipants->execute();
		    		$tabVerifParticipants = $verifParticipants->fetchAll(PDO::FETCH_ASSOC);

		    		if(count($tabVerifParticipants) > 0){ //il y a au moins une participation
				    	//suppression des participations
			    		$suppParticipants = $this->connexion->prepare("DELETE FROM Participe_a
			    			WHERE NomEvenement = '".$this->nomEvent."'");
			    		$suppParticipants->execute();

			    		//vérifier que tous les participants ont pu être supprimés
			    		$verifParticipantsF = $this->connexion->prepare("SELECT NumUtilisateur FROM Participe_a
			    		WHERE NomEvenement = '".$this->nomEvent."'");
			    		$verifParticipantsF->execute();
			    		$tabVerifParticipantsF = $verifParticipantsF->fetchAll(PDO::FETCH_ASSOC);

		    			if(count($tabVerifParticipantsF) > 0){ //il reste encoredes participants
		    				return "Tous les participants n'ont pas pu être supprimés.";
		    			}
		    		}

			    	//suppression de l'évènement
		    		$resultDeleteEvent = $this->connexion->prepare("DELETE FROM Evenement WHERE NomEvenement = '".$this->nomEvent."'");
		    		$resultDeleteEvent->execute();

		    		//suppression de la localisation
		    		$resultDeleteEventLoc = $this->connexion->prepare("DELETE FROM Localisation WHERE IdLocalisation = '".$idLoc."'");
		    		$resultDeleteEventLoc->execute();

		    		//vérification de la suppression de l'évènement (car une suppression vide renvoie quand même true)
		    		$verifDelete = $this->connexion->prepare("SELECT NumEvenement FROM Evenement
		    			WHERE NomEvenement = '".$this->nomEvent."'");
		    		$verifDelete->execute();
		    		$tabVerifDelete = $verifDelete->fetchAll(PDO::FETCH_ASSOC);

		    		//vérification de la suppression de la localisation(car une suppression vide renvoie quand même true)
		    		$verifDeleteLoc = $this->connexion->prepare("SELECT IdLocalisation FROM Localisation
		    			WHERE IdLocalisation = '".$idLoc."'");
		    		$verifDeleteLoc->execute();
		    		$tabVerifDeleteLoc = $verifDeleteLoc->fetchAll(PDO::FETCH_ASSOC);

		    		if(count($tabVerifDelete) == 0 && count($tabVerifDeleteLoc) == 0) return "Cet évènement a été supprimé.";
		    		else return "Cet évènement n'a pas pu être supprimé.";
		    	}
		    	else return "Vous n'êtes pas le créateur.";
		    }
		    else return "Cet évènement n'existe pas.";
	    }

	    public function add_event(){

	    	//vérification de l'unicité
	    	$verifUnicite = $this->connexion->prepare("SELECT NumEvenement FROM Evenement WHERE NomEvenement = '".$this->nomEvent."'");
    		$verifUnicite->execute();
    		$tabVerifUnicité = $verifUnicite->fetchAll(PDO::FETCH_ASSOC);

    		if(count($tabVerifUnicité) == 0){ //évènement n'existe pas déjà = OK !
    			//recherche du nom du type de l'évènement
			    $resultTypeAct = $this->connexion->prepare("SELECT NumTypeEvenement FROM TypeEvenement
			    	WHERE NomTypeEvenement = '".$this->nomTypeEvenement."'");
			    $resultTypeAct->execute();

			    $tableau = $resultTypeAct->fetch();
				$idTypeAct = $tableau['NumTypeEvenement'];

				//insertion de la nouvelle localisation
			    $resultInsertLoc = $this->connexion->prepare("INSERT INTO Localisation (Latitude, Longitude, CommentaireLieu)
			    	VALUES ('".$this->latitude."', '".$this->longitude."','".$this->commentaireLieu."')");
			    $resultInsertLoc->execute();
			    //id de la nouvelle localisation
				$idLocEvent = $this->connexion->lastInsertId(); 

			    //insertion du nouvel évènement
			    $resultInsertEvent = $this->connexion->prepare("INSERT INTO Evenement (HeureEvenement, DateEvenement, IdLocalisation, CapaciteEvenement, NumTypeEvenement, nomEvenement, NumUtilisateur) VALUES
			    	('".$this->heure."','".$this->dateEvent."','".$idLocEvent."','".$this->capaciteEvent."', '".$idTypeAct."',
			    	'".$this->nomEvent."','".$this->NumUtilisateur."')");
			    $resultInsertEvent->execute();

			    //vérification si l'évènement a bien été ajouté
			    $verifUniciteF = $this->connexion->prepare("SELECT NumEvenement FROM Evenement WHERE NomEvenement = '".$this->nomEvent."'");
	    		$verifUniciteF->execute();
	    		$tabVerifUnicitéF = $verifUniciteF->fetchAll(PDO::FETCH_ASSOC);

	    		if(count($tabVerifUnicitéF) == 1) return "L'évènement a bien été ajouté.";
	    		else return "L'évènement n'a pas été ajouté.";
    		}
    		else return "Cet évènement existe déjà.";
	    }
	}
?>
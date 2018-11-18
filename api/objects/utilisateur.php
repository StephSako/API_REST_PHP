<?php
	
	class Utilisateur{		
		private $connexion;
		private $mail;
		private $mdpasse;

		private $pseudo;
		private $commentaire;

		private $latitude;
		private $longitude;
		private $idUser;

		public function __construct(){
	    	include(realpath('../config/bdd.php'));
	    	$this->connexion = $co;	    	

	        //lors de l'inscription
	        if (func_num_args() == 6){
	        	$this->mail = func_get_arg(0);
	        	$this->mdpasse = func_get_arg(1);
	            $this->pseudo = func_get_arg(2);
	            $this->commentaire = func_get_arg(3);
	            $this->latitude = func_get_arg(4);
	            $this->longitude = func_get_arg(5);
	        }
	        else if (func_num_args() == 2){
	        	//lors de la connection
				$this->mail = func_get_arg(0);
		        $this->mdpasse = func_get_arg(1);
	    	}
	    	else if (func_num_args() == 1){
	    		//autres traitements
	    		$this->idUser = func_get_arg(0);
	    	}
	    }

		public function connexion(){

            //recherche du pseudo dans la BD
            $resultLogin = $this->connexion->prepare("SELECT NumUtilisateur FROM Utilisateur WHERE MailUtilisateur = '".$this->mail."' AND MDPUtilisateur = '".$this->mdpasse."'");
            $resultLogin->execute();

		    $tableau = $resultLogin->fetch();
			$idTypeAct = $tableau['NumUtilisateur'];
			
			if($idTypeAct == null) return -1;
			else return $idTypeAct;
		}

		public function inscription(){
			//si le compte n'existe pas déjà
			$resultMail = $this->connexion->prepare("SELECT * FROM Utilisateur WHERE MailUtilisateur = '".$this->mail."'");
			$resultMail->execute();

			$tabEvent = $resultMail->fetchAll();
            if (count($tabEvent) == 0){

            	//création de la localisation dans la table Localisation
                $resultInsertLoc = $this->connexion->prepare("INSERT INTO Localisation (latitude, longitude) VALUES ('".$this->latitude."','".$this->longitude."')");
                $resultInsertLoc->execute();
                //récupération du dernier id inséré dans la table Localisation pour créer la première localisation du nouvel utilisateur
            	$idLoc = $this->connexion->lastInsertId();

                //insertion du nouvel utilisateur
                $resultInsertUser = $this->connexion->prepare("INSERT INTO Utilisateur (Pseudo, MDPUtilisateur, MailUtilisateur, Commentaire, IdLocalisation) VALUES ('" . $this->pseudo . "','" . $this->mdpasse . "','" . $this->mail . "','" . $this->commentaire . "','".$idLoc."')");
            	//récupération du dernier id inséré dans la table Utilisateur
            	$resultInsertUser->execute();
            	$id = $this->connexion->lastInsertId();
                return $id;
            }
            else return -1;
		}

		public function cancelParticipation($nomEvent){

			//vérification de la possibilité d'annulation de l'évènement
			$verifCancelEvent = $this->connexion->prepare("SELECT NumEvenement FROM Participe_a
				WHERE NumUtilisateur = '".$this->idUser."'
				AND NomEvenement = '".$nomEvent."'");
		    $verifCancelEvent->execute();
		    $tabVerifCancel = $verifCancelEvent->fetchAll(PDO::FETCH_ASSOC);

		    if(count($tabVerifCancel) == 1){ //la participation existe et est unique

				//annulation de la participation à l'évènement
			    $resultCancelEvent = $this->connexion->prepare("DELETE FROM Participe_a
			    	WHERE NumUtilisateur = '".$this->idUser."' AND NomEvenement = '".$nomEvent."'");
			    $resultCancelEvent->execute();

			    //verification de l'annulation de l'évènement
			    $verifCancelEventF = $this->connexion->prepare("SELECT NumEvenement FROM Participe_a
			    	WHERE NumUtilisateur = '".$this->idUser."' AND NomEvenement = '".$nomEvent."'");
			    $verifCancelEventF->execute();
			    $tabVerifCancelF = $verifCancelEventF->fetchAll(PDO::FETCH_ASSOC);

			    if(count($tabVerifCancelF) == 0)
					return "Participation annulée.";
				else
					return "Participation non annulée.";
			}
			else return "Il n'y a pas de participation.";
		}

		public function participateEvent($nomEvent){

			//vérifier si l'utilisateur et l'évènement existent
			$verifExistUSER = $this->connexion->prepare("SELECT U.NumUtilisateur, E.NomEvenement FROM Evenement E, Utilisateur U
				WHERE U.NumUtilisateur = '".$this->idUser."' AND E.NomEvenement = '".$nomEvent."'");
			$verifExistUSER->execute();
			$tabVerifExistUSER = $verifExistUSER->fetchAll(PDO::FETCH_ASSOC);

			$verifExistJO = $this->connexion->prepare("SELECT U.NumUtilisateur, E.NomEvenementJO FROM EvenementJO E, Utilisateur U
				WHERE U.NumUtilisateur = '".$this->idUser."' AND E.NomEvenementJO = '".$nomEvent."'");
			$verifExistJO->execute();
			$tabVerifExistJO = $verifExistJO->fetchAll(PDO::FETCH_ASSOC);

			if(count($tabVerifExistUSER) == 1 || count($tabVerifExistJO) == 1){ //les informations existent

				//vérifier si l'utilisateur ne participe déjà pas à l'évènement
				$verifVerifAlready = $this->connexion->prepare("SELECT NomEvenement FROM Participe_a
					WHERE NomEvenement = '".$nomEvent."' AND NumUtilisateur = '".$this->idUser."'");
				$verifVerifAlready->execute();
				$tabAlready = $verifVerifAlready->fetchAll(PDO::FETCH_ASSOC);

				if(count($tabAlready) == 0){ //la participation n'existe pas encore

					//vérifier s'il s'agit d'un event JO ...
					$verifNomEventJO = $this->connexion->prepare("SELECT NumEvenementJO FROM EvenementJO WHERE NomEvenementJO = '".$nomEvent."'");
					$verifNomEventJO->execute();

					//... ou d'un event USER
					$verifNomEventUSER = $this->connexion->prepare("SELECT NumEvenement FROM Evenement WHERE NomEvenement = '".$nomEvent."'");
					$verifNomEventUSER->execute();

					$tabEventJO = $verifNomEventJO->fetchAll(PDO::FETCH_ASSOC);
					$tabEventUSER = $verifNomEventUSER->fetchAll(PDO::FETCH_ASSOC);

					if(count($tabEventJO) == 1){
						$idEvent = $tabEventJO[0]['NumEvenementJO'];
					}
					else if(count($tabEventUSER) == 1){
						$idEvent = $tabEventUSER[0]['NumEvenement'];
					}

					//participation du contact à l'évènement
				    $resultParticipateEvent = $this->connexion->prepare("INSERT INTO Participe_a (NumUtilisateur, NumEvenement, NomEvenement) VALUES ('".$this->idUser."','".$idEvent."','".$nomEvent."')");
				    $resultParticipateEvent->execute();

				    return "'".$this->idUser."' participe à l'évènement '".$nomEvent."'";
				}
				else return "Vous participez déjà à cet évènement.";
			}
			else return "Ces informations n'existent pas.";
		}

		public function delete_contact($idUserDeleted){

			//vérifier si les deux sont pas nuls
			if($idUserDeleted != null && $this->idUser != null){

		    	//vérifier si l'amitié existe
	    		$verifExistence = $this->connexion->prepare("SELECT NumUtilisateur_1 FROM est_ami_de
	    			WHERE (NumUtilisateur = '".$this->idUser."'
	    			AND NumUtilisateur_1 = '".$idUserDeleted."')
	    			OR (NumUtilisateur_1 = '".$this->idUser."'
	    			AND NumUtilisateur = '".$idUserDeleted."')");
	    		$verifExistence->execute();
	    		$tabVerifExiste = $verifExistence->fetchAll(PDO::FETCH_ASSOC);

	    		if(count($tabVerifExiste) == 1){//l'amitié existe bien

		    		$resultDeleteFriendship = $this->connexion->prepare("DELETE FROM est_ami_de
		    			WHERE (NumUtilisateur = '".$this->idUser."'
	    			AND NumUtilisateur_1 = '".$idUserDeleted."')
	    			OR (NumUtilisateur_1 = '".$this->idUser."'
	    			AND NumUtilisateur = '".$idUserDeleted."')");
		    		$resultDeleteFriendship->execute();

		    		//vérification de la suppression (car une suppression vide renvoie quand même true)
		    		$verifDelete = $this->connexion->prepare("SELECT * FROM est_ami_de
		    			WHERE NumUtilisateur = '".$this->idUser."'
		    			AND NumUtilisateur_1 = '".$idUserDeleted."'");
		    		$verifDelete->execute();
		    		$tabVerifDelete = $verifDelete->fetchAll(PDO::FETCH_ASSOC);

		    		if(count($tabVerifDelete) == 0) return "Ce contact a été supprimé.";
		    		else return "Ce contact n'a pas pu être supprimé.";
			    }
			    else return "Ce contact n'existe pas.";
			}
			else return "Vous devez entrer 2 IDs.";
	    }

	    public function add_contact($idUserAdded){

	    	//vérifier l'existence des deux utilisateurs ...
    		$verifExistence = $this->connexion->prepare("SELECT NumUtilisateur FROM Utilisateur
    			WHERE(NumUtilisateur = '".$this->idUser."') OR (NumUtilisateur = '".$idUserAdded."')");
    		$verifExistence->execute();
    		$tabVerifExiste = $verifExistence->fetchAll(PDO::FETCH_ASSOC);

    		if(count($tabVerifExiste) == 2){ //les deux utilisateurs existent bien

    			//... et si l'amitié n'existe pas déjà
	    		$resultDoubleFriendship = $this->connexion->prepare("SELECT NumUtilisateur FROM est_ami_de
	    		WHERE (NumUtilisateur = '".$this->idUser."'
				AND NumUtilisateur_1 = '".$idUserAdded."')
				OR (NumUtilisateur_1 = '".$this->idUser."'
				AND NumUtilisateur = '".$idUserAdded."')");
	    		$resultDoubleFriendship->execute();
	    		$tabVerifDoubleExiste = $resultDoubleFriendship->fetchAll(PDO::FETCH_ASSOC);

	    		if(count($tabVerifDoubleExiste) == 0){
		    		$resultAddContact = $this->connexion->prepare("INSERT INTO est_ami_de VALUES
		    		('".$this->idUser."','".$idUserAdded."')");
		    		$resultAddContact->execute();

		    		//vérification de l'ajout
		    		$verifAdd = $this->connexion->prepare("SELECT NumUtilisateur FROM est_ami_de
	    			WHERE NumUtilisateur = '".$this->idUser."'AND NumUtilisateur_1 = '".$idUserAdded."'");
		    		$verifAdd->execute();
		    		$tabVerifAdd = $verifAdd->fetchAll(PDO::FETCH_ASSOC);

		    		if(count($tabVerifAdd) == 1) return "Ce contact a été ajouté.";
		    		else return "Ce contact n'a pas pu être ajouté.";
		    	}
		    	else return "Vous êtes déjà ami.";
		    }
		    else return "Ce contact n'existe pas.";
	    }

	    public function estAmi($idFriend){

	    	//vérifier si les deux IDs ne sont pas null
	    	if(!empty($this->idUser)){
	    		if(!empty($idFriend)){
			    	//vérifier l'existence des deux utilisateurs ...
		    		$verifExistence = $this->connexion->prepare("SELECT NumUtilisateur FROM Utilisateur
		    			WHERE(NumUtilisateur = '".$this->idUser."') OR (NumUtilisateur = '".$idFriend."')");
		    		$verifExistence->execute();
		    		$tabVerifExiste = $verifExistence->fetchAll(PDO::FETCH_ASSOC);

		    		if(count($tabVerifExiste) == 2){ //les deux utilisateurs existent bien

			    		$resultDoubleFriendship = $this->connexion->prepare("SELECT NumUtilisateur FROM est_ami_de
			    		WHERE (NumUtilisateur = '".$this->idUser."'
						AND NumUtilisateur_1 = '".$idFriend."')
						OR (NumUtilisateur_1 = '".$this->idUser."'
						AND NumUtilisateur = '".$idFriend."')");
			    		$resultDoubleFriendship->execute();
			    		$tabVerifDoubleExiste = $resultDoubleFriendship->fetchAll(PDO::FETCH_ASSOC);

			    		if(count($tabVerifDoubleExiste) == 1) return true;
			    		else return false;
			    	}else return false;
			    }else return false;
			}else return false;
	    }

	    public function updateLoc($latitude, $longitude){
	    	//vérifier l'existence de l'utilisateur
    		$verifExistence = $this->connexion->prepare("SELECT IdLocalisation FROM Utilisateur
    			WHERE NumUtilisateur = '".$this->idUser."'");
    		$verifExistence->execute();
    		$tabVerifExiste = $verifExistence->fetchAll(PDO::FETCH_ASSOC);

    		if(count($tabVerifExiste) == 1){

    			$idLoc = $tabVerifExiste[0]['IdLocalisation'];

	    		$resultUpdate = $this->connexion->prepare("UPDATE Localisation
				SET latitude = '".$latitude."', longitude = '".$longitude."'
				WHERE IdLocalisation = '".$idLoc."'");
	    		$resultUpdate->execute();

	    		return "Mise à jour effectuée.";
	    	}else return "Mise à jour non effectuée.";
	    }
	}
?>
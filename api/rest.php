<?php
	header('Content-Type: application/json');
	
	function get_request_method(){
		return $_SERVER['REQUEST_METHOD'];
	}

	function retour_json_sign_in_up($id,$message,$success){
		$retour ["id"] = $id;
		$retour ["message"] = $message;
		$retour ["success"] = $success;

		echo json_encode($retour);
	}

	function retour_json_sign_list_contact($id,$tab,$message,$success){
		$retour ["id"] = $id;
		$retour ["tab"] = $tab;
		$retour ["message"] = $message;
		$retour ["success"] = $success;

		echo json_encode($retour);
	}

	function retour_json_events_map($tabEventJO,$tabEventUser,$message){
		
		$retour ["tabEventJO"] = $tabEventJO;
		$retour ["tabEventUser"] = $tabEventUser;
		$retour ["message"] = $message;

		echo json_encode($retour);
	}

	function retour_json_details_event($NumEvenement, $Description, $Participants,$message, $success){
		$retour ["Participants"] = $Participants;
		$retour ["Description"] = $Description;
		$retour ["NumEvenement"] = $NumEvenement;
		$retour ["message"] = $message;
		$retour ["success"] = $success;

		echo json_encode($retour);
	}

	function retour_json_details_eventDetails($NomEvenement, $NumEvenement, $NomTypeEvenement, $DateEvenement, $HeureEvenement, $Description, $Localisation, $Participants,$message, $success){
		$retour ["NomEvenement"] = $NomEvenement;
		$retour ["Localisation"] = $Localisation;
		$retour ["Participants"] = $Participants;
		$retour ["NomTypeEvenement"] = $NomTypeEvenement;
		$retour ["HeureEvenement"] = $HeureEvenement;
		$retour ["DateEvenement"] = $DateEvenement;
		$retour ["Description"] = $Description;
		$retour ["NumEvenement"] = $NumEvenement;
		$retour ["message"] = $message;
		$retour ["success"] = $success;

		echo json_encode($retour);
	}

	function retour_json_details_user($NumUtilisateur, $Pseudo, $Commentaire, $Localisation, $events){
		$retour ["NumUtilisateur"] = $NumUtilisateur;
		$retour ["Pseudo"] = $Pseudo;
		$retour ["Commentaire"] = $Commentaire;
		$retour ["Localisation"] = $Localisation;
		$retour ["Evenements"] = $events;

		echo json_encode($retour);
	}

	function retour_json_message($message){
		$retour ["message"] = $message;

		echo json_encode($retour);
	}
?>
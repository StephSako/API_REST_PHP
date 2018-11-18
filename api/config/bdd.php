<?php

	$username = "prj_android_s4";
	$password = "MO0qufHZrWSejw7R";

	try {
	    $co = new PDO('mysql:host=localhost;dbname=prj_android_s4', $username, $password);
	} catch (PDOException $e) {
	    print "Erreur !: <br/>";
	    die();
	}
?>
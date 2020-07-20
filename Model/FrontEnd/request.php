<?php

function connexionDataBase () {
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=projet4', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		$bdd->exec("SET CHARACTER SET utf8");
		return $bdd;
	}

	catch (Exception $e) {
		die ('Erreur: ' .$e->getMessage());
	}
}

?>
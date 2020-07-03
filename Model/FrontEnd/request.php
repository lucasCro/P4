<?php

function connexionDataBase () {
	try {
		$bdd = new PDO('mysql:host=db5000595641.hosting-data.io;dbname=dbs574520;charset=utf8', 'dbu981999', 'Luc@s170288', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		return $bdd;
	}

	catch (Exception $e) {
		die ('Erreur: ' .$e->getMessage());
	}
}

?>
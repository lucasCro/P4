<?php 

function getChapter () {
	$bdd = connexionDataBase();
	$reponse = $bdd->prepare('SELECT *, DATE_FORMAT(date_ajout, "%d/%m/%Y") AS date_fr FROM chapitre WHERE numeroChapitre=? AND publication != "null"');
	if (isset($_GET['choice'])){
		$reponse->execute(array($_GET['choice']));
	} else {
		$reponse->execute(array(1));
	}
	return $reponse;
}

	// Recuperation des commentaires correspondant au chapitre choisi:
function getComments () {
	$bdd = connexionDataBase();
	$reponse2 = $bdd->prepare('SELECT *, DATE_FORMAT(date_ajout, "%d/%m/%Y %Hh%i") AS date_fr  FROM commentaire WHERE numeroChapitre = ? ORDER BY id DESC LIMIT 0, 5 ');
	if (isset($_GET['choice'])){
		$reponse2->execute(array($_GET['choice']));
	} else {
		$reponse2->execute(array(1));
	}
	return $reponse2;
}
?>
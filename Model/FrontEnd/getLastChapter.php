<?php 

function getLastChapter() {
	$dbb = connexionDataBase();
	$reponse = 	$dbb->query('SELECT *, DATE_FORMAT(date_ajout, "%d/%m/%Y") AS date_fr FROM chapitre WHERE publication IS NOT NULL ORDER BY id  DESC LIMIT 1 ');
	return $reponse;
}
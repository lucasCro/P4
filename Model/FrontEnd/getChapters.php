<?php 
function getChapters () {
	$dbb = connexionDataBase();
	$chaptersList = $dbb->query('SELECT * FROM chapitre  WHERE publication IS NOT NULL');
	return $chaptersList;
}

function getDraft () {
	$dbb = connexionDataBase();
	$draftList = $dbb->query('SELECT * FROM chapitre WHERE publication IS NULL ');
	return $draftList;
}
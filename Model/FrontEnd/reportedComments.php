<?php

function getReportedComments () {
	$dbb = connexionDataBase();

	$reportList = $dbb->query('SELECT *, DATE_FORMAT(date_ajout, "%d/%m/%Y %Hh%i") AS date_fr FROM commentaire WHERE signaler != 0 OR signaler != "NULL" ');

	return $reportList;
}

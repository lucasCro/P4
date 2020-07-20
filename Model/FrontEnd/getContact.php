<?php 
function getContacts () {
	$dbb = connexionDataBase();

	$contactsList = $dbb->query('SELECT * FROM contact');

	return $contactsList;
}
<?php 
require('Model/FrontEnd/request.php');
require('Model/FrontEnd/chapitreRequest.php');

function displayChapters () {
	getChapter();
}

function displayContact () {
	require('View/FrontEnd/contact.php');
}

function displayHome () {
	require('View/FrontEnd/accueil.php');
}

function displayAdmin () {
	require('View/FrontEnd/admin.php');
}

function adminView () {
	require('View/FrontEnd/adminView.php');
}

?>


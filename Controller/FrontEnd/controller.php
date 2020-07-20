<?php 
require('Model/FrontEnd/request.php');
require('Model/FrontEnd/chapitreRequest.php');

function displayChapters () {
	$reponse = getChapter();
	$reponse2 = getComments();
	require('View/FrontEnd/chapitre.php');
}

function displayContact () {
	require('View/FrontEnd/contact.php');
}

function displayHome () {
	require('View/FrontEnd/accueil.php');
}

function displayAdmin () {
	require('Model/FrontEnd/adminConnexion.php');
	require('Model/FrontEnd/getContact.php');
	require('Model/FrontEnd/getChapters.php');
	require('Model/FrontEnd/reportedComments.php');
	$validPassword = checkLog();
	$chaptersList = getChapters();
	$draftList = getDraft();
	$contactsList = getContacts();
	$reportList = getReportedComments();
	require('View/FrontEnd/admin.php');
}





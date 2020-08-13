<?php 
require('Model/FrontEnd/request.php');
require('Model/FrontEnd/chapitreRequest.php');

function displayChapters () {
	require('Model/FrontEnd/traitementCommentaire.php');
	require('Model/FrontEnd/traitementSignalement.php');
	require('Model/FrontEnd/getLastChapter.php');
	require('Model/FrontEnd/getChapters.php');
	$chaptersList = getChapters();
	$getLastChapter = getLastChapter();
	$reponse = getChapter();
	$reponse2 = getComments();
	$validChapter = getAllValidChapter();
	require('View/FrontEnd/chapitre.php');
}

function displayContact () {
	require('View/FrontEnd/contact.php');
}

function displayHome () {
	require('Model/FrontEnd/getLastChapter.php');
	$reponse = getLastChapter();
	require('View/FrontEnd/accueil.php');
	require('View/FrontEnd/template.php');
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





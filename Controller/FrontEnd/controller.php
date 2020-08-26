<?php 
require_once('Model/FrontEnd/ConnexionManager.php');
require_once('Model/FrontEnd/ChapterManager.php');
require_once('Model/FrontEnd/CommentManager.php');
require_once('Model/FrontEnd/ContactManager.php');

function displayChapters () {

	$chapterManager = new ChapterManager();
	$commentManager = new CommentManager();

	$chaptersList = $chapterManager->getChapters();
	$getLastChapter = $chapterManager->getLastChapter();
	$reponse = $chapterManager->getChapter();
	$reponse2 = $commentManager->getComments();
	$validChapter = $chapterManager->getAllValidChapter();
	require('View/FrontEnd/chapitre.php');
}

function displayContact () {
	require('View/FrontEnd/contact.php');
}

function displayHome () {

	$chapterManager = new ChapterManager();

	$reponse = $chapterManager->getLastChapter();
	require('View/FrontEnd/accueil.php');
	require('View/FrontEnd/template.php');
}

function displayAdmin () {

	$chapterManager = new ChapterManager();
	$commentManager = new CommentManager();
	$contactManager = new ContactManager();
	$connexionManager = new ConnexionManager();

	$validPassword = $connexionManager->checkAdminLog();
	$chaptersList = $chapterManager->getChapters();
	$draftList = $chapterManager->getDraft();
	$contactsList = $contactManager->getContacts();
	$allComments = $commentManager->getAllComments();
	$validComments = $commentManager->getAllValidComments();
	$reportList = $commentManager->getReportedComments();
	require('View/FrontEnd/admin.php');
}





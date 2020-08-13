<?php 

function getChapter() {
	$bdd = connexionDataBase();
	$reponse = $bdd->prepare('SELECT *, DATE_FORMAT(date_ajout, "%d/%m/%Y") AS date_fr FROM chapitre WHERE numeroChapitre=? AND publication IS NOT NULL');
	if (isset($_GET['choice'])){
		$reponse->execute(array($_GET['choice']));
	} else {
		$reponse->execute(array(1));
	}
	return $reponse;
}

	// Recuperation des commentaires correspondant au chapitre choisi:
function getComments() {
	$bdd = connexionDataBase();
	$reponse2 = $bdd->prepare('SELECT *, DATE_FORMAT(date_ajout, "%d/%m/%Y %Hh%i") AS date_fr  FROM commentaire WHERE numeroChapitre = ? ORDER BY id DESC LIMIT 0, 5 ');
	if (isset($_GET['choice'])){
		$reponse2->execute(array($_GET['choice']));
	} else {
		$reponse2->execute(array(1));
	}
	return $reponse2;
}

function getAllValidChapter() {
	$bdd = connexionDataBase();
	$validChapter = $bdd->query('SELECT numeroChapitre FROM chapitre WHERE publication IS NOT NULL');
	return $validChapter;
}

function chapterCreation() {
	$bdd = connexionDataBase();
	// Verification si la case "brouillon" a ete coché ou non 
	if(isset($_POST['draft'])) {
		$publication = NULL;
	} else {
		$publication = 1;
	}
	// traitement de l'image envoyé
	if(isset($_FILES['image_chapter'])){
		// recupérer l'extension du fichier
		$infosFichier = pathinfo($_FILES['image_chapter']['name']);
		$extension_file = $infosFichier['extension'];
		// liste des extensions autorisées 
		$extension_array = array('jpg', 'jpeg', 'gif', 'png');
		//teste differente conditions
		if($_FILES['image_chapter']['size'] > 1000000) {
			echo "La taille de votre image est trop grosse";
		} elseif (!in_array($extension_file, $extension_array)) {
			echo "L'extension n'est pas autorisé (extensions autorisées: jpg, jpeg, gif, png)";
		} elseif ($_FILES['image_chapter']['size'] <= 1000000 && in_array($extension_file, $extension_array) && $_FILES['image_chapter']['error'] == 0) {
			move_uploaded_file($_FILES['image_chapter']['tmp_name'], 'Public/images/Chapitre/image_chapter' . $_POST['chapterNumber'] );
			echo "L'image a bien été uploadé !";
		} else {
			echo "Un probleme est survenue l'image n'a pas pu etre importé";
		}
	}
	$request = $bdd->prepare('INSERT INTO chapitre(numeroChapitre, date_ajout, titre, article, image, imageAlt, publication) VALUES (:numeroChapitre, NOW(), :titre, :article, :image, :imageAlt, :publication)');
	$request->execute(array(
		'numeroChapitre' => $_POST['chapterNumber'], 
		'titre' => $_POST['chapterTitle'], 
		'article' => strip_tags($_POST['mytextarea']), 
		'image' => 'src="Public/images/Chapitre/image_chapter'.$_POST['chapterNumber'],
		'imageAlt' => $_POST['imageAlt'], 
		'publication' => $publication  
	));
}

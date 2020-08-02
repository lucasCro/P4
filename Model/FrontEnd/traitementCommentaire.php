<?php 

function sendComment () {
	if (isset($_POST['pseudo']) && isset($_POST['commentaire']) && isset($_POST['titre']) && isset($_POST['chapterNumber'])) {

		$pseudo = $_POST['pseudo'];
		$commentaire = $_POST['commentaire'];
		$titre = $_POST['titre'];
		$chapitre = $_POST['chapterNumber'];
		
	} else {
		echo '<p> tout les champs n\'ont pas etaient remplis </p>';
	}

	$bdd = connexionDataBase();
	$comment = $bdd->prepare('INSERT INTO `commentaire`(`titre`, `pseudo`, `date_ajout`, `content`, `numeroChapitre`) VALUES ( :titre, :pseudo, NOW(), :content, :numeroChapitre)');
	$comment->execute(array(
		'titre' => $titre,
		'pseudo' => $pseudo,
		'content' => $commentaire,
		'numeroChapitre' => $chapitre
	));
	header('Location: ../../index.php?action=displayChapters&choice='.$chapitre);
}



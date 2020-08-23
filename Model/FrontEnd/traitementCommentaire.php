<?php 

function sendComment() {
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

function deleteComment() {
	$bdd = connexionDataBase();
	$request = $bdd->prepare('DELETE FROM commentaire WHERE id = :id');
	$request->execute(array('id' => $_POST['comment_id']));
	echo "Le commentaire à été supprimé !";
}

function validComment() {
	$bdd = connexionDataBase();
	$request = $bdd->prepare('UPDATE commentaire SET valide = 1, signaler = NULL WHERE id = :id');
	$request->execute(array('id' => $_POST['comment_id']));
	return $statut = "Le commentaire à été validé !";
}



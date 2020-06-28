<?php 

function sendComment () {
require('request.php');

if (isset($_POST['pseudo']) && isset($_POST['commentaire']) && isset($_POST['titre'])) {

	$pseudo = $_POST['pseudo'];
	$commentaire = $_POST['commentaire'];
	$titre = $_POST['titre'];

	if (isset($_GET['choice'])){
		$numeroChapitre = $_GET['choice'];
	} else {
		$numeroChapitre = 1;
	}
	
} else {
	echo '<p> tout les champs n\'ont pas etaient remplis </p>';
}

$bdd = connexionDataBase();
$comment = $bdd->prepare('INSERT INTO `commentaire`(`titre`, `pseudo`, `date_ajout`, `content`, `numeroChapitre`) VALUES ( :titre, :pseudo, NOW(), :content, :numeroChapitre)');
$comment->execute(array(
	'titre' => $titre,
	'pseudo' => $pseudo,
	'content' => $commentaire,
	'numeroChapitre' => $numeroChapitre
));
header('Location: ../../index.php?action=displayChapters&choice='.$numeroChapitre);
}

sendComment();

?>



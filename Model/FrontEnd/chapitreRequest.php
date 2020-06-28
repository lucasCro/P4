<?php 

function getChapter () {
	$bdd = connexionDataBase();
	$reponse = $bdd->prepare('SELECT *, DATE_FORMAT(date_ajout, "%d/%m/%Y") AS date_fr FROM chapitre WHERE id=?');
	if (isset($_GET['choice'])){
		$reponse->execute(array($_GET['choice']));
	} else {
		$reponse->execute(array(1));
	}

	while ($data = $reponse->fetch()) {
		$articleTitle = $data['titre'];
		$articleParagraph = $data['article'];
		$articleDate = $data['date_fr'];
		$imgSrc = $data['image'];
		$imgAlt = $data['imageAlt'];
	}

	$reponse->closeCursor();

	// Recuperation des commentaires correspondant au chapitre choisi:

	$reponse2 = $bdd->prepare('SELECT *, DATE_FORMAT(date_ajout, "%d/%m/%Y %Hh%i") AS date_fr  FROM commentaire WHERE numeroChapitre = ? ORDER BY date_fr DESC LIMIT 0, 5 ');
	if (isset($_GET['choice'])){
		$reponse2->execute(array($_GET['choice']));
	} else {
		$reponse2->execute(array(1));
	}

	// Mise en page des commentaires et insertion dans une variable $listcommentaire:

	ob_start();
	while ($data = $reponse2->fetch()) {
		$id = $data['id'];
		$commentaireTitle = $data['titre'];
		$commentaireParagraph = $data['content'];
		$commentaireDate = $data['date_fr'];
		$commentaireAuthor = $data['pseudo'];
	?>

    <h2><?= $commentaireTitle ;?></h2>
    <p id="commentaireDate"><?= $commentaireDate ;?></p>
    <p id="commentaireAuteur"><?= $commentaireAuthor ;?></p>
    <p><?= $commentaireParagraph ;?></p>
    <form method="POST" action="/Model/FrontEnd/traitementSignalement.php">
    	<input type="hidden" name="id" value=<?php echo $id ?> />
    	<input type="submit" name="signaler" value="Signaler" />
    </form>

	<?php
	}
	$listCommentaire = ob_get_clean();
	$reponse2->closeCursor();
	require('View/FrontEnd/chapitre.php');
}
?>
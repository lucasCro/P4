<?php
$title = "Chapitres";

// verifie si le chapitre existe et l affiche
while($checkChapter = $validChapter->fetch()) {
if(isset($_GET['choice']) && ($_GET['choice'] == $checkChapter['numeroChapitre'])) {
?>
<?php ob_start(); ?>
<?php
// Ajout d un commentaire :
	//  Test si tous les champs ont ete rempli ET qu aucun n'est null, créé le commentaire
	if (isset($_POST['pseudo']) && $_POST['pseudo'] != null && isset($_POST['commentaire']) && $_POST['commentaire'] != null && isset($_POST['titre']) && $_POST['titre'] != null && isset($_POST['chapterNumber']) && $_POST['chapterNumber'] != null) {

		$comment = new CommentManager();
		$comment->sendComment();
		header('Location: index.php?action=displayChapters&choice='.$_POST['chapterNumber']);			
	}
	// Si un signalement est effectué :
	elseif(isset($_POST['id'])) {
		$comment = new CommentManager();
		$comment->signaler();
	}
?>
<div id="chapitre">

	<!-- creation du menu deroulant pour selectionner un chapitre -->
	<label for="listeChapitre"><h2>Choisissez un chapitre</h2></label>
	<select name="listeChapitre" id="listeChapitre" onChange="location = this.options[this.selectedIndex].value;" >
		<option>Choix du Chapitre</option>
		<?php 
		$allChapters = new ChapterManager();
		$availableChapter = $allChapters->getAllValidChapter();
		while($chapter = $availableChapter->fetch()) { 
		?>
			<option value="index.php?action=displayChapters&choice=<?=$chapter['numeroChapitre'];?>">Chapitre <?=$chapter['numeroChapitre'];?></option>
		<?php 
		}; ?>  	
	</select>

	<?php 
   		$data = $reponse->fetch();
		$articleTitle = $data['titre'];
		$articleParagraph = $data['article'];
		$articleDate = $data['date_fr'];
		$imgSrc = $data['image'];
		$imgAlt = $data['imageAlt'];
	?>

	<figure>
        <img src="<?= $imgSrc ?>" alt="<?= $imgAlt ?>" class="img_chapter"/>
  	</figure>
	
	<div>
		<h1><?= $articleTitle ;?></h1>
	  	<p>Publié le <?= $articleDate ;?></p>
	  	<p><?= $articleParagraph ;?></p>
	</div>

	<hr>

	<div>
		<h1>Laissez un commentaire !</h1>
		<form method="post" action="">
			<!--Recuperation variable pour determiner le numero du chapitre : -->
			<?php if(isset($_GET['choice'])){
				$chapterNumber = $_GET['choice'];
			} else {
				$chapterNumber = 1;
			}
			?>
			<input type="hidden" name="chapterNumber" value=<?php echo $chapterNumber ?> />
			<input type="text" name="pseudo" placeholder="Pseudo" />
	    	<input type="text" name="titre" placeholder="Titre du Commentaire" />
			<textarea name="commentaire" placeholder="Laissez votre commentaire ici !"></textarea>
			<input type="submit" value="Poster" />
		</form>
	</div>

	<div id="listeCommentaire">
		<h1>Liste des commentaires</h1>

    	<?php while ($data = $reponse2->fetch()) {
		$id = $data['id'];
		$commentaireTitle = $data['titre'];
		$commentaireParagraph = $data['content'];
		$commentaireDate = $data['date_fr'];
		$commentaireAuthor = $data['pseudo'];
		?>
		<table>
			<tr>
				<th>Titre :</th>
				<th>Pseudo :</th>
				<th>Date :</th>
			</tr>
			<tr>
				<td><?= $commentaireTitle ;?></td>
				<td><?= $commentaireAuthor ;?></td>
				<td><?= $commentaireDate ;?></td>
			</tr>
			<tr>
				<td colspan="3"><?= $commentaireParagraph ;?></td>
			</tr>
		</table>
		<form method="POST" action="" class="form_signalement"	>
	    	<input type="hidden" name="id" value=<?php echo $id ?> />
	    	<input class="btn_report" type="submit" name="signaler" value="Signaler" />
		</form>		
		<br />		
		<?php
		}
		$reponse2->closeCursor();
		?>
	</div>
</div>
<?php $content = ob_get_clean();
// sortir du while si on trouve un chapitre
break;} elseif (isset($_GET['choice']) && ($_GET['choice'] != $checkChapter['numeroChapitre'])) {
	$content = "Le chapitre demandé n'est pas disponible";
}
// fin de la boucle while 
}
require('template.php'); ?>
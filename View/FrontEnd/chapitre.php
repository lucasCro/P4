<?php $title = "Chapitres" ;?>
<?php ob_start(); ?>
<div id="chapitre">
	<label for="listeChapitre"><h2>Choisissez un chapitre</h2></label>
	<select name="listeChapitre" id="listeChapitre" onChange="location = this.options[this.selectedIndex].value;" >
		<option>Choix du Chapitre</option>
       	<option value="index.php?action=displayChapters&choice=1">Chapitre 1</option>
       	<option value="index.php?action=displayChapters&choice=2">Chapitre 2</option>
       	<option value="index.php?action=displayChapters&choice=3">Chapitre 3</option>
       	<option value="index.php?action=displayChapters&choice=4">Chapitre 4</option>
       	<option value="index.php?action=displayChapters&choice=5">Chapitre 5</option>
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
        <img <?= $imgSrc ?> <?= $imgAlt ?> class="img_chapter"/>
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

	<?php
		if (isset($_POST['pseudo'])){
			sendComment();
		}
	?>

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
				<th>Titre</th>
				<td><?= $commentaireTitle ;?></td>
			</tr>
			<tr>
				<th>Date</th>
				<td><?= $commentaireDate ;?></td>
			</tr>
			<tr>
				<th>Pseudo</th>
				<td><?= $commentaireAuthor ;?></td>
			</tr>
			</tr>
			<tr>
				<td><?= $commentaireParagraph ;?></td>
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
	<?php 
	if(isset($_POST['id'])) {
		signaler();
	}
	?>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
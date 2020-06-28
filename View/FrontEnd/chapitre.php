<?php $title = "Chapitres" ;?>
<?php ob_start(); ?>
<div id="chapitre">
	<label for="listeChapitre"><h2>Choisissez un chapitre</h2></label>
	<select name="listeChapitre" id="listeChapitre" onChange="location = this.options[this.selectedIndex].value;">
       <option value="index.php?action=displayChapter&choice=1">Chapitre 1</option>
       <option value="index.php?action=displayChapters&choice=2">Chapitre 2</option>
       <option value="index.php?action=displayChapters&choice=3">Chapitre 3</option>
       <option value="index.php?action=displayChapters&choice=4">Chapitre 4</option>
       <option value="index.php?action=displayChapters&choice=5">Chapitre 5</option>
	</select>

	<figure>
        <img <?= $imgSrc ?> <?= $imgAlt ?> />
  </figure>

  <h1><?= $articleTitle ;?></h1>
  <p>Publié le <?= $articleDate ;?></p>
  <p><?= $articleParagraph ;?></p>
	<h1>Commentaires</h1>

	<form method="post" action="Model/FrontEnd/traitementCommentaire.php">
		<input type="text" name="pseudo" placeholder="Pseudo" />
    <input type="text" name="titre" placeholder="Titre du Commentaire" />
		<textarea name="commentaire" placeholder="Laissez votre commentaire ici !"></textarea>
		<input type="submit" value="Poster"/>
	</form>

	<div id="listeCommentaire">
    <?= $listCommentaire ?>
	</div>

</div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
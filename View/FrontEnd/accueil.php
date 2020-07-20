<?php 
$title = "Jean Forteroche";

$dbb = connexionDataBase();
$reponse = $dbb->query('SELECT * FROM chapitre ORDER BY id DESC LIMIT 1');
$lastChapterView = $reponse->fetch();
$reponse->closeCursor();
?>
<?php ob_start(); ?>
<article>
     <h1 id="articleTitle">Billet pour l'Alaska</h1>
     <p id="articleParagraph">
          Billet pour l'Alaska est le dernier roman du celebre auteur Jean Forteroche, on pourra y retrouver le celebre detective voyageant au travers de ce pays de glace a la recherche d indices pouvant expliquer une étrange disparition alors que ce dernier été en expedition scientifique.... 
     </p>
     <p>
          Un roman plan de suspense, de rebondissement, surement son meilleur roman a ce jour... a découvrir sous forme de "feuilletonnage" avec l'apparition d'un nouveau chapitre chaque mois !
     </p>
</article>
<div id="lastChapter">
     <h1>Dernier Chapitre paru</h1>
     <h2> <?= $lastChapterView['titre'] ;?></h2>
     <p> <?= $lastChapterView['date_ajout'] ;?> </p>
     <p> <?= $lastChapterView['article'] ;?> </p>   
</div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
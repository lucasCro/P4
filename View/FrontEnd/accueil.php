<?php 
$title = "Jean Forteroche";

$dbb = connexionDataBase();
$reponse = $dbb->query('SELECT * FROM chapitre ORDER BY id DESC LIMIT 1');
$lastChapterView = $reponse->fetch();
$reponse->closeCursor();
?>
<?php ob_start(); ?>
<article>
     <h1 id="articleTitle">Biographie</h1>
     <p id="articleParagraph">
     Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam egestas, felis non tincidunt
     tempus, leo augue volutpat odio, ac viverra tortor ante nec diam. Vestibulum consectetur neque quis
     orci bibendum, a ultricies lacus consectetur. Aenean eget facilisis ipsum, at tempor risus. In at
     nisi in purus dapibus aliquam ac at magna. Curabitur pharetra sapien velit, ac tempus metus varius
     sed. Curabitur mauris velit, rhoncus sit amet nunc non, viverra eleifend neque. Nulla facilisi.
     Mauris ipsum est, gravida vel eleifend quis, dapibus eu elit. Cras enim purus, egestas eget luctus
     aliquet, pretium sed lectus. Donec sit amet ex ut dui ultrices aliquam eget non lacus. Vestibulum
     ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Aliquam venenatis augue
     a sapien volutpat, accumsan elementum enim volutpat. Aliquam interdum ac est quis facilisis. Aenean
     rutrum venenatis ligula sodales accumsan. Donec vel cursus metus.
     </p>
</article>
<div id="lastChapter">
     <h1>Dernier Chapitre paru</h1>
     <h2> <?= $lastChapterView['titre'] ;?></h2>
     <p> <?= $lastChapterView['date'] ;?> </p>
     <p> <?= $lastChapterView['article'] ;?> </p>   
</div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
<?php

function getReportedComments () {

	$dbb = connexionDataBase();

	$reportList = $dbb->query('SELECT *, DATE_FORMAT(date_ajout, "%d/%m/%Y %Hh%i") AS date_fr FROM commentaire WHERE signaler != 0 OR signaler != "NULL" ');
	ob_start();
	while ($data = $reportList->fetch()) {
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

	<?php
	}
	$reportedComments = ob_get_clean();
	$reportList->closeCursor();
	require('../../View/FrontEnd/adminView.php');
}
getReportedComments();
?>
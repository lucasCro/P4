<?php

function signaler () {
	require('request.php');

	if (isset($_POST['id'])) {

		$id = $_POST['id'];
		$dbb = connexionDataBase();
		$signalement = $dbb->prepare('UPDATE commentaire SET signaler = 1 WHERE id = ?');
		$signalement->execute(array(
			$id
		));
		echo "Votre signalement à bien été effectué !";
	} else {
		echo 'echec du signalement';
	}

}

signaler();
?>
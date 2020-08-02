<?php

function signaler () {
	if (isset($_POST['id'])) {

		$id = $_POST['id'];
		$dbb = connexionDataBase();
		$signalement = $dbb->prepare('UPDATE commentaire SET signaler = 1 WHERE id = ?');
		$signalement->execute(array(
			$id
		));
	} 
}

?>
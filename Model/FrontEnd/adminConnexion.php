<?php
function checkLog () {
	if (isset($_POST['pseudo']) && isset($_POST['password'])) {
		$pseudo = $_POST['pseudo'];
		$password = $_POST['password'];

		$bdd = connexionDataBase();

		$request = $bdd->query('SELECT * FROM admin');

		while($log = $request->fetch()) {
			if($log['pseudo'] == $pseudo && $log['password'] == $password) {
				return true;
			} else {
				echo 'Votre identifiant et/ou mot de passe est/sont incorrecte(s)';
			}
		}
	}
}

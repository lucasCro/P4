<?php
class ConnexionManager {

	public function connexionDataBase() {
		try {
			$dbb = new PDO('mysql:host=localhost;dbname=jeanforteroche', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
			$dbb->exec("SET CHARACTER SET utf8");
			return $dbb;
		}

		catch (Exception $e) {
			die ('Erreur: ' .$e->getMessage());
		}
	}

	public function checkAdminLog() {
		if (isset($_POST['pseudo']) && isset($_POST['password'])) {
			$pseudo = strip_tags($_POST['pseudo']);
			$password = strip_tags($_POST['password']);

			$connexion = new connexionManager();
			$dbb = $connexion->connexionDataBase();

			$request = $dbb->query('SELECT * FROM admin');

			while($log = $request->fetch()) {
				if($log['pseudo'] == $pseudo && $log['password'] == $password) {
					return true;
				} else {
					echo 'Votre identifiant et/ou mot de passe est/sont incorrecte(s)';
				}
			}
		}
	}
}


?>
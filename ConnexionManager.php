<?php
class ConnexionManager {

	private const prefix_salt = "impossible";
	private const suffix_salt = "trouver";

	public function connexionDataBase() {
		try {
			$dbb = new PDO('mysql:host=db5000595641.hosting-data.io;dbname=dbs574520;charset=utf8', 'dbu981999', 'Luc@s170288', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
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
			$password = md5(self::prefix_salt . strip_tags($_POST['password']) . self::suffix_salt);

			$connexion = new connexionManager();
			$dbb = $connexion->connexionDataBase();

			$request = $dbb->query('SELECT * FROM admin');

			while($log = $request->fetch()) {
				if($log['pseudo'] == $pseudo && $log['password'] == $password) {
					return true;
				}
			}

			echo 'Votre identifiant et/ou mot de passe est/sont incorrecte(s)';
		}
	}

	public function createPassword() {
		$pseudoAdmin = $_POST['pseudo_admin'];
		$passwordAdmin = md5(self::prefix_salt . strip_tags($_POST['mdp_admin']) . self::suffix_salt);
		$dbb = $this->connexionDataBase();
		$newPassword = $dbb->prepare('INSERT INTO admin(pseudo, password) VALUES (:pseudo, :password)');
		$newPassword->execute(array(
			'pseudo' => $pseudoAdmin,
			'password' => $passwordAdmin
			));
		echo "Nouvel administrateur créé !";
	}

	public function deconnexion() {
		session_destroy();
		header("Location: index.php?action=displayAdmin");
	}
}
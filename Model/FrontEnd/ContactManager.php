<?php 
class ContactManager {

	public function getContacts() {
		$connexion = new connexionManager();
		$dbb = $connexion->connexionDataBase();

		$contactsList = $dbb->query('SELECT * FROM contact');

		return $contactsList;
	}	

	public function createContact() {
		if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['objet']) && isset($_POST['mail']) && isset($_POST['mail'])) {

			$nom = strip_tags($_POST['nom']);
			$prenom = strip_tags($_POST['prenom']);
			$objet = strip_tags($_POST['objet']);
			$mail = strip_tags($_POST['mail']);
			$message = strip_tags($_POST['message']);

			$connexion = new connexionManager();
			$dbb = $connexion->connexionDataBase();
			$request = $bdd->prepare('INSERT INTO contact (nom, prenom, objet, mail, message) VALUES (:nom, :prenom, :objet, :mail, :message) ');
			$request->execute(array(
				'nom' => $nom,
				'prenom' => $prenom,
				'objet' => $objet,
				'mail' => $mail,
				'message' => $message
				 ));
			echo 'Votre message à bien été envoyé !';
			echo '<a href="../index.php?action=displayContact"> Revenir au formulaire de contact </a>';

		} else {
			echo 'Vous n\'avez pas remplis tout les champs du formulaire';
			echo '<a href="../index.php?action=displayContact"> Revenir au formulaire de contact </a>';
		}
	}
}

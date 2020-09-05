<?php 
class ContactManager {

	public function getContacts() {
		$connexion = new connexionManager();
		$dbb = $connexion->connexionDataBase();

		$contactsList = $dbb->query('SELECT * FROM contact');

		return $contactsList;
	}	

	public function createContact() {
		
		$nom = strip_tags($_POST['nom']);
		$prenom = strip_tags($_POST['prenom']);
		$objet = strip_tags($_POST['objet']);
		$mail = strip_tags($_POST['mail']);
		$message = strip_tags($_POST['message']);

		$connexion = new connexionManager();
		$dbb = $connexion->connexionDataBase();
		$request = $dbb->prepare('INSERT INTO contact (nom, prenom, objet, mail, message) VALUES (:nom, :prenom, :objet, :mail, :message) ');
		$request->execute(array(
			'nom' => $nom,
			'prenom' => $prenom,
			'objet' => $objet,
			'mail' => $mail,
			'message' => $message
			 ));
		echo 'Votre message à bien été envoyé !';
	}

	public function deleteContact() {
		$connexion = new connexionManager();
		$dbb = $connexion->connexionDataBase();
		$request = $dbb->prepare('DELETE FROM contact WHERE id = :id');
		$request->execute(array('id' => $_POST['contact_id']));
		unset($_POST['delete_Contact']);
		return $statut = "Le contact à été supprimé !";
	}
}

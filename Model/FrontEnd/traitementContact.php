<?php
require('request.php');

if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['objet']) && isset($_POST['mail']) && isset($_POST['mail'])) {

	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$objet = $_POST['objet'];
	$mail = $_POST['mail'];
	$message = $_POST['message'];

	$bdd = connexionDataBase();
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

?>
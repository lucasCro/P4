<?php $title = "Contact" ;?>
<?php ob_start(); ?>
<?php 
if (isset($_POST['nom']) && $_POST['nom'] != null && isset($_POST['prenom']) && $_POST['prenom'] != null && isset($_POST['objet']) && $_POST['objet'] != null && isset($_POST['mail']) && $_POST['mail'] != null) {
		$contact = new ContactManager();
		$contact->createContact();
	}

?>
<div id="contact">
	<form method="post">
		<h1>Nous contacter: </h1>
		<input type="text" name="nom" placeholder="Nom"/>
		<input type="text" name="prenom" placeholder="Prenom"/>
		<input type="text" name="objet" placeholder="Objet de votre message"/>
		<input type="mail" name="mail" placeholder="Votre adresse mail" />
		Votre message : 
		<textarea name="message" placeholder="Contenue de votre message"></textarea>
		<div>
			J'accepte la politique de traitement des données du site :
			<input type="checkbox" name="validationRGPD" id="rgpd" required />
		</div>
		<button id="envoyer">Envoyer</button>
	</form>	
</div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
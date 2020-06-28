<?php $title = "Contact" ;?>
<?php ob_start(); ?>
<div id="contact">
	<form method="post" action="../../Model/FrontEnd/traitementContact.php">
		<h1>Nous contacter: </h1>
		<input type="text" name="nom" placeholder="Nom"/>
		<input type="text" name="prenom" placeholder="Prenom"/>
		<input type="text" name="objet" placeholder="Objet de votre message"/>
		<input type="mail" name="mail" placeholder="Votre adresse mail" />
		<textarea name="message" placeholder="Contenue de votre message"></textarea>
		<button id="envoyer">Envoyer</button>
	</form>	
</div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
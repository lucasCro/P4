<?php
session_start();

$title = 'administrateur';

ob_start();
// Formulaire pour entrer un mot de passe Admin
?>
<?php 
// Verification Mot de passe et affichage partie administrateur
if($validPassword == true || (isset($_SESSION['admin']) && $_SESSION['admin'] == true)) {
	if(!isset($_SESSION['admin'])) {
		$_SESSION['admin'] = true;
	}
	require('View/FrontEnd/adminView.php');
} else {
	?>
	<form method="POST" action="">
		<h1>Entrez vos identifiants administrateur:</h1>
		<input type="text" name="pseudo" placeholder="Pseudo" / >
		<input type="password" name="password" placeholder="Mot de Passe" />
		<input type="submit" name="connection" />
	</form>
<?php }
$content = ob_get_clean();
require('template.php');
session_destroy();
?>


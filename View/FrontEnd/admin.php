<?php

$title = 'administrateur';

ob_start();

?>

<form method="POST" action="../../Model/FrontEnd/adminConnexion.php">
	<h1>Entrez vos identifiants administrateur:</h1>
	<input type="text" name="pseudo" placeholder="Pseudo" / >
	<input type="password" name="password" placeholder="Mot de Passe" />
	<input type="submit" name="connection" placeholder="Connection" />
</form>

<?php 
$content = ob_get_clean();
require('template.php');
?>
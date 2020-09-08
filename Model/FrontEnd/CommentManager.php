<?php 
class CommentManager {
	public function sendComment() {
		// Creation des variables et applications de strip tags pour empecher les intrusion sql
		$pseudo = strip_tags($_POST['pseudo']);
		$commentaire = strip_tags($_POST['commentaire']);
		$titre = strip_tags($_POST['titre']);
		$chapitre = strip_tags($_POST['chapterNumber']);
		// Connexion a la base de données
		$connexion = new connexionManager();
		$dbb = $connexion->connexionDataBase();
		// Ajout du commentaire
		$comment = $dbb->prepare('INSERT INTO `commentaire`(`titre`, `pseudo`, `date_ajout`, `content`, `numeroChapitre`) VALUES ( :titre, :pseudo, NOW(), :content, :numeroChapitre)');
		$comment->execute(array(
			'titre' => $titre,
			'pseudo' => $pseudo,
			'content' => $commentaire,
			'numeroChapitre' => $chapitre
		));
	}

	public function deleteComment() {
		$connexion = new connexionManager();
		$dbb = $connexion->connexionDataBase();
		$request = $dbb->prepare('DELETE FROM commentaire WHERE id = :id');
		$request->execute(array('id' => $_POST['comment_id']));
		echo "Le commentaire à été supprimé !";
		header("Location: index.php?action=displayAdmin");
	}

	public function validComment() {
		$connexion = new connexionManager();
		$dbb = $connexion->connexionDataBase();
		$request = $dbb->prepare('UPDATE commentaire SET valide = 1, signaler = NULL WHERE id = :id');
		$request->execute(array('id' => $_POST['comment_id']));
		header("Location: index.php?action=displayAdmin#btn_underMenu_valid_comments");
	}

	public function signaler() {
		if (isset($_POST['id'])) {

			$id = $_POST['id'];
			$connexion = new connexionManager();
			$dbb = $connexion->connexionDataBase();
			$signalement = $dbb->prepare('UPDATE commentaire SET signaler = 1 WHERE id = ?');
			$signalement->execute(array(
				$id
			));
		}
	}

	// Recuperation des commentaires correspondant au chapitre choisi:
	public function getComments() {
		$connexion = new connexionManager();
		$dbb = $connexion->connexionDataBase();
		$reponse2 = $dbb->prepare('SELECT *, DATE_FORMAT(date_ajout, "%d/%m/%Y %Hh%i") AS date_fr  FROM commentaire WHERE numeroChapitre = ? ORDER BY id DESC LIMIT 0, 5 ');
		if (isset($_GET['choice'])) {
			$reponse2->execute(array($_GET['choice']));
		} else {
			$reponse2->execute(array(1));
		}
		return $reponse2;
	}

	public function getAllComments() {
		$connexion = new connexionManager();
		$dbb = $connexion->connexionDataBase();
		$reponse2 = $dbb->query('SELECT *, DATE_FORMAT(date_ajout, "%d/%m/%Y %Hh%i") AS date_fr  FROM commentaire ORDER BY numeroChapitre ');
		return $reponse2;
	}

	public function getAllValidComments() {
		$connexion = new connexionManager();
		$dbb = $connexion->connexionDataBase();
		$validComments = $dbb->query('SELECT *, DATE_FORMAT(date_ajout, "%d/%m/%Y %Hh%i") AS date_fr FROM commentaire WHERE valide IS NOT NULL');
		return $validComments;
	}

	public function getReportedComments () {
		$connexion = new connexionManager();
		$dbb = $connexion->connexionDataBase();

		$reportList = $dbb->query('SELECT *, DATE_FORMAT(date_ajout, "%d/%m/%Y %Hh%i") AS date_fr FROM commentaire WHERE signaler != 0 OR signaler != "NULL" ');

		return $reportList;
	}

}



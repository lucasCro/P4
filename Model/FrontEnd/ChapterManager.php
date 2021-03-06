<?php 
class ChapterManager {

	public function getChapters() {
		$connexion = new connexionManager();
		$dbb = $connexion->connexionDataBase();
		$chaptersList = $dbb->query('SELECT * FROM chapitre  WHERE publication IS NOT NULL ORDER BY numeroChapitre');
		return $chaptersList;
	}

	public function getDraft() {
		$connexion = new connexionManager();
		$dbb = $connexion->connexionDataBase();
		$draftList = $dbb->query('SELECT * FROM chapitre WHERE publication IS NULL ');
		return $draftList;
	}

	public function getChapter() {
		$connexion = new connexionManager();
		$dbb = $connexion->connexionDataBase();
		$reponse = $dbb->prepare('SELECT *, DATE_FORMAT(date_ajout, "%d/%m/%Y") AS date_fr FROM chapitre WHERE numeroChapitre=? AND publication IS NOT NULL');
		if (isset($_GET['choice'])){
			$reponse->execute(array($_GET['choice']));
		} else {
			$reponse->execute(array(1));
		}
		return $reponse;
	}

	public function getAllValidChapter() {
		$connexion = new connexionManager();
		$dbb = $connexion->connexionDataBase();
		$validChapter = $dbb->query('SELECT * FROM chapitre WHERE publication IS NOT NULL ORDER BY numeroChapitre');
		return $validChapter;
	}

	public function chapterCreation() {
		$connexion = new connexionManager();
		$dbb = $connexion->connexionDataBase();

		// Recuperation des numeros de chapitre deja existants et publié
		$chapter = new ChapterManager(); 
		$publishedChapterNumber = $chapter->getAllValidChapter();
		while($chapterNumberList = $publishedChapterNumber->fetch()) {
			// verifie que ça ne soit pas une modification d un chapitre et que le numero de chapitre n existe pas deja
			if((!isset($_POST['modify'])) && $_POST['chapterNumber'] == $chapterNumberList['numeroChapitre']) {
				echo "Le numéro de chapitre est deja utilisé !";
				return;
			}
			// si c est une modification de chapitre, supprime l ancien chapitre ayant le meme numero !
			elseif(isset($_POST['modify']) && ($_POST['modify'] == $chapterNumberList['numeroChapitre']) && isset($_POST['chapterTitle']) && isset($_POST['chapterNumber']) && isset($_POST['mytextarea'])) {
					$request = $dbb->prepare('DELETE FROM chapitre WHERE numeroChapitre = :numeroChapitre');
					$request->execute(array('numeroChapitre' => $_POST['modify']));
			} 
		}

		// Verification de la presence d'une image envoyé
		if($_FILES['image_chapter'] == null) {
			return $statut = "Un probleme est survenu, l'image n'a pas pu etre importé";
		} elseif(isset($_FILES['image_chapter'])) {
			// recupérer l'extension du fichier
			$infosFichier = pathinfo($_FILES['image_chapter']['name']);
			$extension_file = $infosFichier['extension'];
			// liste des extensions autorisées 
			$extension_array = array('jpg', 'jpeg', 'gif', 'png');
			//teste differentes conditions
			if($_FILES['image_chapter']['size'] > 1000000) {
				return $statut = "La taille de votre image est trop grosse";
			} elseif (!in_array($extension_file, $extension_array)) {
				return $statut = "L'extension n'est pas autorisé (extensions autorisées: jpg, jpeg, gif, png)";
			} elseif ($_FILES['image_chapter']['size'] <= 1000000 && in_array($extension_file, $extension_array) && $_FILES['image_chapter']['error'] == 0) {
				move_uploaded_file($_FILES['image_chapter']['tmp_name'], 'Public/images/Chapitre/image_chapter' . $_POST['chapterNumber'] );
				$statut = "L'image a bien été uploadé !";
			}
		}

		// Verification si la case "brouillon" a ete coché ou non 
		if(isset($_POST['draft'])) {
			$publication = NULL;
		} else {
			$publication = 1;
		}

		// Creation du chapitre
		$request = $dbb->prepare('INSERT INTO chapitre(numeroChapitre, date_ajout, titre, article, image, imageAlt, publication) VALUES (:numeroChapitre, NOW(), :titre, :article, :image, :imageAlt, :publication)');
		$request->execute(array(
			'numeroChapitre' => strip_tags($_POST['chapterNumber']), 
			'titre' => strip_tags($_POST['chapterTitle']), 
			'article' => strip_tags($_POST['mytextarea']), 
			'image' => 'Public/images/Chapitre/image_chapter'.strip_tags($_POST['chapterNumber']),
			'imageAlt' => strip_tags($_POST['imageAlt']), 
			'publication' => $publication  
		));

		// Reinitialisation des variables
		unset($_POST['chapterTitle'], $_POST['chapterNumber'], $_POST['mytextarea'], $_FILES['image_chapter']);

		// Renvoi de la variable indiquant le statut de l'action
		header("Location: index.php?action=displayAdmin");
	}

	public function deleteChapter() {
		$connexion = new connexionManager();
		$dbb = $connexion->connexionDataBase();
		$request = $dbb->prepare('DELETE FROM chapitre WHERE id = :id');
		$request->execute(array('id' => $_POST['chapter_id']));
		unset($_POST['delete_Comment']);
		//header('Location : ../index.php?action=displayAdmin');
		return;
	}

	public function getModifyChapter() {
		$connexion = new connexionManager();
		$dbb = $connexion->connexionDataBase();
		$modifyChapter = $dbb->prepare('SELECT * FROM chapitre WHERE id = :id');
		$modifyChapter->execute(array('id' => $_POST['chapter_id']));
		return $modifyChapter;
	}

	public function getLastChapter() {
		$connexion = new connexionManager();
			$dbb = $connexion->connexionDataBase();
		$reponse = 	$dbb->query('SELECT *, DATE_FORMAT(date_ajout, "%d/%m/%Y") AS date_fr FROM chapitre WHERE publication IS NOT NULL ORDER BY id  DESC LIMIT 1 ');
		return $reponse;
	}
}

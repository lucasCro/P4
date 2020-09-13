<!-- traitement des données lors de la création d un chapitre -->
<?php 
if(isset($_POST['chapterTitle']) && isset($_POST['chapterNumber']) && isset($_POST['mytextarea'])) {
	$chapter = new ChapterManager();
	$chapter->chapterCreation();
} elseif(isset($_POST['delete_Comment'])) {
	$comment = new CommentManager();
	$comment->deleteComment();
	header("Location: index.php?action=displayAdmin#div_admin_commentaires");
} elseif (isset($_POST['valid_Comment'])) {
	$comment = new CommentManager();
	$comment->validComment();
} elseif (isset($_POST['delete_Chapter'])) {
	$chapter = new ChapterManager();
	$chapter->deleteChapter();
	header("Location: index.php?action=displayAdmin#div_admin_chapitres");
} elseif (isset($_POST['modify_Chapter'])) {
	$chapter = new ChapterManager();
	$modifyChapter = $chapter->getModifyChapter();	
} elseif (isset($_POST['pseudo_admin']) && isset($_POST['mdp_admin'])) {
	$admin = new ConnexionManager();
	$admin->createPassword();
} elseif (isset($_POST['deconnexion'])) {
	$admin = new ConnexionManager();
	$admin->deconnexion();
}  elseif (isset($_POST['delete_Contact'])) {
	$contact = new ContactManager();
	$contact->deleteContact();
	header("Location: index.php?action=displayAdmin");
}

?>
<!-- GESTION DES CHAPITRES -->
<button id="btn_div_chapitres" class="btn_menu_admin">Chapitres</button>
<div id="div_admin_chapitres">
	<button id="btn_underMenu_creation_chapter" class="btn_underMenu">Création/Modification d'un chapitre</button>
	<!-- formulaire création chapitre -->
	<div id="div_tinyMCE">
		<form method="POST" id="tinyMce_form" enctype="multipart/form-data">
			<table id="tinyMce_table">
				<!-- le php sert a préremplir le formulaire avec les informations si ce dernier a été appelé apres un clique sur un bouton "modifié" -->
				<?php if(isset($modifyChapter)) {$chapter = $modifyChapter->fetch(); } ?>

				<!-- titre du chapitre -->
				<tr>
					<td colspan="2">
						<input type="text" name="chapterTitle" 
						<?php if(isset($modifyChapter)) { ?> 
							value="<?= $chapter['titre'] ?>"
						<?php } else { ?>
							placeholder="Titre du chapitre" 
						<?php }?> >
					</td>
				</tr>

				<tr>
					<!-- Numero du chapitre -->
					<td>Numero du chapitre : <input type="number" name="chapterNumber" max="99" 
					<?php if(isset($modifyChapter)) { ?>
						value="<?= $chapter['numeroChapitre'] ?>"
					<?php ;} ?>
					></td>

					<!-- case a cocher brouillon -->
					<td>Brouillon : <input type="checkbox" name="draft" 
						<?php if(isset($modifyChapter) && $chapter['publication'] == 0) { ?>
							checked 
						<?php } ?>
					></td>
				</tr>

				<!-- choix de l image -->
				<tr>
					<td colspan="2">
						<label for="image">Choisissez l'image (.png, .jpeg) du chapitre : </label>
						<input type="file" id="image" name="image_chapter" accept="image/png, image/jpeg">
					</td>
				</tr>

				<!-- texte alternatif de l image -->
				<tr>
					<td colspan="2">
						<input type="text" name="imageAlt" placeholder="description de l'image en quelques mots"
						<?php if(isset($modifyChapter)) { ?>
							value="<?= $chapter['imageAlt'] ;?>"
						<?php ;} ?>
						>
					</td>
				</tr>						 
			</table>

			<!-- contenue du chapitre -->
			<textarea id="TinyMCE" name="mytextarea">
				<?php if(isset($modifyChapter)) { echo $chapter['article']; } ?>
			</textarea>

			<!-- création d un input caché dans le cas d une modification de chapitre afin de ne pas verifier que le numero de chapitre existe deja lors de la creation du chapitre -->
			<?php 
			if(isset($modifyChapter)) {
			?>
				<input type="hidden" name="modify" value="<?= $chapter['numeroChapitre'] ?>">
			<?php
			}
			?>

			<!-- bouton d'envoi -->
			<input type="submit" name="valider">
		</form>
	</div>	
	<!-- liste des chapitre publiés -->
	<button id="btn_underMenu_chapter_list" class="btn_underMenu">Listes des chapitres publiés</button>
	<div>
		<?php while($chapter = $chaptersList->fetch()) 
		{ ?>
		<div class="item_in_a_list">
			<table>
				<tr><th>Chapitre <?= $chapter['numeroChapitre'] ;?></th></tr>
				<tr><th>Titre: <?= $chapter['titre']; ?></th></tr>
				<tr>
					<td>
						<figure>
							<img src="<?= $chapter['image'];?>" class="img_chapter">
						</figure>
					</td>
				</tr>
				<tr><td>Date: <?= $chapter['date_ajout']; ?></td></tr>
				<tr>
					<td>
						<?= substr($chapter['article'], 0, 200); ?>...
		          		<a href="index.php?action=displayChapters&choice=<?= $chapter['numeroChapitre']; ?>" class="read_more">Lire la suite</a>
		      		</td>
		  		</tr>	
			</table>
			<form method="POST" class="form_signalement" action="index.php?action=displayAdmin#div_tinyMCE">
				<input type="hidden" name="chapter_id" value="<?=$chapter['id']?>">
	    		<button class="btn_admin btn_delete_chapter" name="delete_Chapter">supprimer</button>
	    		<button class="btn_admin btn_modify_chapter" name="modify_Chapter">modifier</button>
			</form>
		</div>
		<?php 
		} ?>
	</div>
	<!-- liste des brouillons -->
	<button id="btn_underMenu_draft_list" class="btn_underMenu">Liste des brouillons</button>
	<div>
		<?php while($chapter = $draftList->fetch()) 
		{ ?>
		<div class="item_in_a_list">
			<table>
				<tr><th>Chapitre <?= $chapter['numeroChapitre'] ;?></th></tr>
				<tr><th>Titre: <?= $chapter['titre']; ?></th></tr>
				<tr><td>Date: <?= $chapter['date_ajout']; ?></td></tr>
				<tr>
					<td>
						<figure>
							<img src="<?= $chapter['image'];?>" class="img_chapter">
						</figure>
					</td>
				</tr>
				<tr>
					<td>
						Contenu: <?= substr($chapter['article'], 0, 150); ?>...
		          		<a href="index.php?action=displayChapters&choice=<?= $chapter['numeroChapitre'] ;?>" class="read_more">Lire la suite</a>
						
					</td>
				</tr>	
			</table>
			<form method="POST" class="form_signalement">
				<input type="hidden" name="chapter_id" value="<?=$chapter['id'];?>">
	    		<button class="btn_admin btn_delete_chapter" name="delete_Chapter">supprimer</button>
	    		<button class="btn_admin btn_modify_chapter" name="modify_Chapter">modifier</button>
			</form>
		</div>
		<?php 
		} ?>
	</div>
</div>

<!--GESTION DES CONTACTS -->
<button id="btn_div_contacts" class="btn_menu_admin">Contacts</button>
<div id="div_admin_contacts">
	<h1>Listes des contacts</h1>	
	<?php while($data = $contactsList->fetch()) { ?>
		<table>
			<tr>
				<td>Nom: <?= $data['nom']; ?></td> 
				<td>Objet: <?= $data['objet']; ?></td>
			</tr>
			<tr>
				<td>Prenom: <?= $data['prenom']; ?></td> 
				<td>Mail: <?= $data['mail']; ?></td>
			</tr>	
			<tr>
				<td colspan="2"><?= $data['message']; ?></td>
			</tr>
		</table>
		<form method="POST" class="form_signalement">
			<input type="hidden" name="contact_id" value="<?= $data['id'] ;?>">
    		<button class="btn_admin btn_delete_chapter" name="delete_Contact">supprimer</button>
		</form>
		<br />
	<?php 
	} ?>
</div>

<!-- GESTION DES COMMENTAIRES -->
<button id="btn_div_commentaires" class="btn_menu_admin">Commentaires </button>
<div id="div_admin_commentaires">
	<!-- Commentaire validés -->
	<button id="btn_underMenu_valid_comments" class="btn_underMenu">Commentaires validés</button>
	<div>
		<?php while ($data = $validComments->fetch()) { ?>
		<div class="item_in_a_list">
			<table>
				<tr>
					<th>Chapitre :</th>
				    <th>Titre :</th>
				    <th>Pseudo :</th>
				    <th>Date :</th>
				</tr>
				<tr>
					<td><?= $data['numeroChapitre'];?></td>
					<td><?= $data['titre'] ;?></td>
					<td><?= $data['pseudo'] ;?></td>
					<td><?= $data['date_fr'] ;?></td>
				</tr>
			    <tr>
			    	<td colspan="4"><?= $data['content'] ;?></td>
			    </tr>
			</table>
			<form method="POST" class="form_signalement">
				<input type="hidden" name="comment_id" value="<?=$data['id'];?>">
	    		<button class="btn_admin btn_delete_chapter" name="delete_Comment">supprimer</button>
			</form>
	    	
		</div>	    
		<?php
		} ?>
	</div>
	<!-- commentaires signalés -->
	<button id="btn_underMenu_reported_comments" class="btn_underMenu">Commentaires signalés</button>
	<div>
		<?php while ($data = $reportList->fetch()) { ?>
		<div class="item_in_a_list">
			<table>
				<tr>
					<th>Chapitre :</th>
				    <th>Titre :</th>
				    <th>Pseudo :</th>
				    <th>Date :</th>
				</tr>
				<tr>
					<td><?= $data['numeroChapitre'];?></td>
					<td><?= $data['titre'] ;?></td>
					<td><?= $data['pseudo'] ;?></td>
					<td><?= $data['date_fr'] ;?></td>
				</tr>
			    <tr>
			    	<td colspan="4"><?= $data['content'] ;?></td>
			    </tr>
			</table>
	    	<form method="POST" class="form_signalement">
				<input type="hidden" name="comment_id" value="<?=$data['id'];?>">
	    		<button class="btn_admin btn_delete_chapter" name="delete_Comment">supprimer</button>
	    		<button class="btn_admin" name="valid_Comment">valider</button>
			</form>
		</div>	    
		<?php
		} ?>
	</div>
	<!-- tous les commentaires  -->
	<button id="btn_underMenu_all_comments" class="btn_underMenu">Tous les commentaires</button>
	<div>
	<?php while ($data = $allComments->fetch()) { ?>
		<div class="item_in_a_list">
			<table>
				<tr>
					<th>Chapitre :</th>
				    <th>Titre :</th>
				    <th>Pseudo :</th>
				    <th>Date :</th>
				</tr>
				<tr>
					<td><?= $data['numeroChapitre'];?></td>
					<td><?= $data['titre'] ;?></td>
					<td><?= $data['pseudo'] ;?></td>
					<td><?= $data['date_fr'] ;?></td>
				</tr>
			    <tr>
			    	<td colspan="4"><?= $data['content'] ;?></td>
			    </tr>
			</table>
	    	<form method="POST" class="form_signalement">
				<input type="hidden" name="comment_id" value="<?=$data['id'];?>">
	    		<button class="btn_admin btn_delete_chapter" name="delete_Comment">supprimer</button>
	    		<button class="btn_admin" name="valid_Comment">valider</button>
			</form>
		</div>	    
	<?php
	} ?>
	</div>
</div>
<div id="sessionAdmin">
	<form method="POST" id="form_addAdmin">
		<h1>Ajouter un administrateur ?</h1>
		<p>
			<input type="TEXT" name="pseudo_admin" placeholder="Pseudo" required="true">
		</p>
		<p>
			<input type="password" name="mdp_admin" placeholder="Mot de passe" required="true">
		</p>
		<p>
			<button name="valid_newAdmin">valider</button>
		</p>
	</form>
	<form method="POST" id="form_deconnexion">
		<button name="deconnexion">Deconnexion ? </button>
	</form>
</div>
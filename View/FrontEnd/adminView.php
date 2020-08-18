<!-- traitement des données lors de la création d un chapitre -->
<?php 
if(isset($_POST['chapterTitle']) && isset($_POST['chapterNumber']) && isset($_POST['mytextarea'])) {
	chapterCreation();
	echo "<p>Chapitre Créé !</p>";
} else if(isset($_POST['chapterTitle']) || isset($_POST['chapterNumber']) || isset($_POST['mytextarea'])){
	echo "<p>Vous n'avez pas rempli tout les champs !</p>";
} elseif(isset($_POST['delete_Comment'])) {
	deleteComment();
} elseif (isset($_POST['valid_Comment'])) {
	validComment();
} elseif (isset($_POST['delete_Chapter'])) {
	deleteChapter();
} elseif (isset($_POST['modify_Chapter'])) {
	$modifyChapter = getModifyChapter();
}

?>
<!--Chapitres-->
<button id="btn_div_chapitres" class="btn_menu_admin">Chapitres</button>
<div id="div_admin_chapitres">
	<button id="btn_underMenu_creation_chapter" class="btn_underMenu">Création d'un chapitre</button>
	<!-- formulaire création chapitre -->
	<div>
		<form method="POST" action="" id="tinyMce_form" enctype="multipart/form-data">
			<table id="tinyMce_table">
				<!-- le php sert a préremplir le formulaire avec les informations si ce dernier a été appelé apres un clique sur un bouton "modifié" -->
				<?php if(isset($modifyChapter)) {$chapter = $modifyChapter->fetch(); } ?>
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
					<td>Numero du chapitre : <input type="number" name="chapterNumber" max="99" 
					<?php if(isset($modifyChapter)) { ?>
						value="<?= $chapter['numeroChapitre'] ?>"
					<?php ;} ?>
					></td>
					<td>Brouillon : <input type="checkbox" name="draft" 
						<?php if(isset($modifyChapter) && $chapter['publication'] == 1) { ?>
							checked 
						<?php } ?>
					></td>
				</tr>
				<tr>
					<td colspan="2">
						<label for="image">Choisissez l'image (.png, .jpeg) du chapitre : </label>
						<input type="file" id="image" name="image_chapter" accept="image/png, image/jpeg"
						<?php if(isset($modifyChapter)) { ?>
							value="<?= $chapter['image'] ?>"
						<?php } ?>
						>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="text" name="imageAlt" placeholder="description de l'image en quelques mots"
						<?php if(isset($modifyChapter)) { ?>
							value="<?= $chapter['imageAlt'] ?>"
						<?php ;} ?>
						>
					</td>
				</tr>						 
			</table>

			<textarea id="TinyMCE" name="mytextarea">
				<?php if(isset($modifyChapter)) { echo $chapter['article']; } ?>
			</textarea>
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
				<tr><th>Titre: <?= $chapter['titre']; ?></th></tr>
				<tr>
					<td>
						<figure>
							<img <?= $chapter['image'];?> class="img_chapter">
						</figure>
					</td>
				</tr>
				<tr><td>Date: <?= $chapter['date_ajout']; ?></td></tr>
				<tr>
					<td>
						<?= substr($chapter['article'], 0, 150); ?>...
						<?php $chapter = $chapter['id']; ?>
		          		<a href="index.php?action=displayChapters&choice=<?= $chapter; ?>" class="read_more">Lire la suite</a>
		      		</td>
		  		</tr>	
			</table>
			<form method="POST" class="form_signalement">
				<input type="hidden" name="chapter_id" value="<?=$chapter?>">
	    		<button class="btn_admin" name="delete_Chapter">supprimer</button>
	    		<button class="btn_admin btn_modify_chapter" name="modify_Chapter">modifier</button>
			</form>
		</div>
		<?php 
		} ?>
	</div>
	<button id="btn_underMenu_draft_list" class="btn_underMenu">Liste des brouillons</button>
	<div>
		<?php while($chapter = $draftList->fetch()) 
		{ ?>
		<div class="item_in_a_list">
			<table>
				<tr><th>Titre: <?= $chapter['titre']; ?></th></tr>
				<tr><td>Date: <?= $chapter['date_ajout']; ?></td></tr>
				<tr>
					<td>
						<figure>
							<img <?= $chapter['image'];?> class="img_chapter">
						</figure>
					</td>
				</tr>
				<tr>
					<td>
						Contenu: <?= substr($chapter['article'], 0, 150); ?>...
						<?php $chapter = $chapter['id']; ?>
		          		<a href="index.php?action=displayChapters&choice=<?=$chapter;?>" class="read_more">Lire la suite</a>
						
					</td>
				</tr>	
			</table>
			<form method="POST" class="form_signalement">
				<input type="hidden" name="chapter_id" value="<?=$chapter;?>">
	    		<button class="btn_admin" name="delete_Chapter">supprimer</button>
	    		<button class="btn_admin btn_modify_chapter" name="modify_Chapter">modifier</button>
			</form>
		</div>
		<?php 
		} ?>
	</div>
</div>

<!--Contacts-->
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
		<br />
	<?php 
	} ?>
</div>

<!--Commentaires-->
<button id="btn_div_commentaires" class="btn_menu_admin">Commentaires </button>
<div id="div_admin_commentaires">
	<button id="btn_underMenu_valid_comments" class="btn_underMenu">Commentaires validés</button>
	<div>
		<?php while ($data = $validComments->fetch()) { ?>
		<div class="item_in_a_list">
			<table>
				<tr>	
				    <td>Titre: <?= $data['titre'] ;?></td>
				</tr>
				<tr>
					<td>Pseudo: <?= $data['pseudo'] ;?></td>
				</tr>
				<tr>
				    <td>Date: <?= $data['date_fr'] ;?></td>
				</tr>
				<tr>
					<td>Numero du chapitre: <?= $data['numeroChapitre'];?></td>
				</tr>
			    <tr>
			    	<td><?= $data['content'] ;?></td>
			    </tr>
			</table>
			<form method="POST" class="form_signalement">
				<input type="hidden" name="comment_id" value="<?=$data['id'];?>">
	    		<button class="btn_admin" name="delete_Comment">supprimer</button>
			</form>
	    	
		</div>	    
		<?php
		} ?>
	</div>
	<button id="btn_underMenu_reported_comments" class="btn_underMenu">Commentaires signalés</button>
	<div>
		<?php while ($data = $reportList->fetch()) { ?>
		<div class="item_in_a_list">
			<table>
				<tr>	
				    <td>Titre: <?= $data['titre'] ;?></td>
				</tr>
				<tr>
					<td>Pseudo: <?= $data['pseudo'] ;?></td>
				</tr>
				<tr>
				    <td>Date: <?= $data['date_fr'] ;?></td>
				</tr>
				<tr>
					<td>Numero du chapitre: <?= $data['numeroChapitre'];?></td>
				</tr>
			    <tr>
			    	<td><?= $data['content'] ;?></td>
			    </tr>
			</table>
	    	<form method="POST" class="form_signalement">
				<input type="hidden" name="comment_id" value="<?=$data['id'];?>">
	    		<button class="btn_admin" name="delete_Comment">supprimer</button>
	    		<button class="btn_admin" name="valid_Comment">valider</button>
			</form>
		</div>	    
		<?php
		} ?>
	</div>
	<button id="btn_underMenu_all_comments" class="btn_underMenu">Tous les commentaires</button>
	<div>
	<?php while ($data = $allComments->fetch()) { ?>
		<div class="item_in_a_list">
			<table>
				<tr>	
				    <td>Titre: <?= $data['titre'] ;?></td>
				</tr>
				<tr>
					<td>Pseudo: <?= $data['pseudo'] ;?></td>
				</tr>
				<tr>
				    <td>Date: <?= $data['date_fr'] ;?></td>
				</tr>
				<tr>
					<td>Numero du chapitre: <?= $data['numeroChapitre'];?></td>
				</tr>
			    <tr>
			    	<td><?= $data['content'] ;?></td>
			    </tr>
			</table>
	    	<form method="POST" class="form_signalement">
				<input type="hidden" name="comment_id" value="<?=$data['id'];?>">
	    		<button class="btn_admin" name="delete_Comment">supprimer</button>
	    		<button class="btn_admin" name="valid_Comment">valider</button>
			</form>
		</div>	    
	<?php
	} ?>
	</div>
</div>

<!-- traitement des données lors de la création d un chapitre -->
<?php 
if(isset($_POST['chapterTitle']) && isset($_POST['chapterNumber']) && isset($_POST['mytextarea'])) {
	chapterCreation();
	echo "Chapitre Créé !";
} else if(isset($_POST['chapterTitle']) || isset($_POST['chapterNumber']) || isset($_POST['mytextarea'])){
	echo "Vous n'avez pas rempli tout les champs !";
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
				<tr>
					<td colspan="2">
						<input type="text" name="chapterTitle" placeholder="Titre du chapitre">
					</td>
				</tr>
				<tr>
					<td>Numero du chapitre : <input type="number" name="chapterNumber" max="99" ></td>
					<td>Brouillon : <input type="checkbox" name="draft" checked></td>
				</tr>
				<tr>
					<td colspan="2">
						<label for="image">Choisissez l'image (.png, .jpeg) du chapitre : </label>
						<input type="file" id="image" name="image_chapter" accept="image/png, image/jpeg">
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="text" name="imageAlt" placeholder="description de l'image en quelques mots">
					</td>
				</tr>						 
			</table>

			<textarea id="TinyMCE" name="mytextarea">
				Hello, World!
			</textarea>
			<input type="submit" name="valider">
		</form>
	</div>	

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
			<button class="btn_admin">Modifier</button>
		    <button class="btn_admin">Supprimer</button>
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
						Contenu: <?= substr($chapter['article'], 0, 150); ?>...
						<?php $chapter = $chapter['id']; ?>
		          		<a href="index.php?action=displayChapters&choice=<?= $chapter; ?>" class="read_more">Lire la suite</a>
						
					</td>
				</tr>	
			</table>
			<button class="btn_admin">Modifier</button>
		    <button class="btn_admin">Supprimer</button>
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
	<button class="btn_underMenu">Commentaires validés</button>
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
			    	<td><?= $data['content'] ;?></td>
			    </tr>
			</table>
	    	<button class="btn_admin">valider</button>
	    	<button class="btn_admin">supprimer</button>
		</div>	    
		<?php
		} ?>
	</div>
	<button class="btn_underMenu">Tous les commentaires</button>
</div>

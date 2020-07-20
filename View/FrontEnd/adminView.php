
<div id="TinyMCE">	
</div>
<!--Chapitres-->
<button id="btn_div_chapitres" class="btn_menu_admin">Chapitres</button>
<div id="div_admin_chapitres">	
	<h1>Listes des chapitres publiés</h1>
	<?php while($chapter = $chaptersList->fetch()) 
	{ ?>
	<table>
		<tr><th>Titre: <?= $chapter['titre']?></th></tr>
		<tr><td>Date: <?= $chapter['date_ajout'] ?></td></tr>
		<tr><td><?= $chapter['article']?></td></tr>	
	</table>
	<br />
	<?php 
	} ?>

	<h1>Listes des brouillons</h1>
	<?php while($chapter = $draftList->fetch()) 
	{ ?>
	<table>
		<tr><th>Titre: <?= $chapter['titre']?></th></tr>
		<tr><td>Date: <?= $chapter['date_ajout'] ?></td></tr>
		<tr><td>Contenu: <?= $chapter['article']?></td></tr>	
	</table>
	<br />
	<?php 
	} ?>
</div>
<!--Contacts-->
<button id="btn_div_contacts" class="btn_menu_admin">Contacts</button>
<div id="div_admin_contacts">
	<h1>Listes des contacts</h1>	
	<?php while($data = $contactsList->fetch()) { ?>
		<table>
			<tr>
				<td>Nom: <?= $data['nom'] ?></td> 
				<td>Objet: <?= $data['objet']?></td>
			</tr>
			<tr>
				<td>Prenom: <?= $data['prenom']?></td> 
				<td>Mail: <?= $data['mail']?></td>
			</tr>	
			<tr>
				<td colspan="2"><?= $data['message']?></td>
			</tr>
		</table>
		<br />
	<?php 
	} ?>
</div>
<!--Commentaires-->
<button id="btn_div_commentaires" class="btn_menu_admin">Commentaires </button>
<div id="div_admin_commentaires">
	<h1>Commentaires signalés</h1>
	<?php while ($data = $reportList->fetch()) { ?>
		<table>
			<tr>	
			    <td><?= $data['titre'] ;?></td>
			</tr>
			<tr>
				<td><?= $data['pseudo'] ;?></td>
			</tr>
			<tr>
			    <td><?= $data['date_fr'] ;?></td>
			    
			</tr>
		    <tr>
		    	<td><?= $data['content'] ;?></td>
		    </tr>
		</table>
    	<button class="btn_comments">valider</button>
    	<button class="btn_comments">supprimer</button>
	    <br/>
	<?php
	} ?>
</div>

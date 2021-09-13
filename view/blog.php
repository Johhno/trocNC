
		
	<?php $title = 'Espace personnel';?>
	<?php ob_start(); ?>
	<?php $content = ob_get_clean(); ?>
							
	<div id="presentation">	 
		
		<form method="post" action="/troc/index.php/annoncer">									
							
			<h1> Bienvenue <?php echo $email_user; ?> </h1>
			
			<div>
				<label for="titre"> Titre annonce </label> :
			</div>
			
			<div>
				<input type="text" name="titre" id="titre" placeholder="defaut" maxlength="10" />
			</div>
			
			<div>
				<label for="description"> Description </label> :
			</div>
			<div>
				<input type="text" name="description" id="description" maxlength="12"  />
			</div>
			
			<div>
				<label for="description"> Etat</label> :
			</div>
			
			<div>						
				<select name='etat'>:
					<option value='Tres Bon état'>Très Bon état </option> 
					<option value='Bon etat'>Bon état </option> 
					<option value='Etat moyen'>Etat moyen</option> 
				</select>
			</div>
			
			<div>
				<label for="preference"> Preference </label> :
			</div>

			<div>
				<input type="text" name="preference" id="preference" maxlength="20"  />
			</div>
			
			<div>
				<label for="categorie"> Categorie </label> :
			</div>
			
			<div>
				<input type="text" name="categorie" id="categorie" maxlength="12"  />
			</div>
			
			<input type="submit" value="Envoyer">
			
		</form>
		
		<h3>Liste des annonces poster</h3>
		
		<form method='GET' action="/troc/index.php/test1">
		<table class="reference" > 
			<tr>
				<th>Titre</th>
				<th>Annonce</th>
			</tr>
			
		<?php foreach( $posts as $post ) : ?>
		
			<tr>
				<td> <?php echo $post['titre']; ?></td>
				<td> <?php echo $post['description']; ?></td>
				
				<!--Recupère l'ID de l'annonce et l'envoie vers le front controller-->
				<a href='/troc/index.php/supprimer?id=<?php echo $post['id'];?>'><input type='button' name='supprimer'>Supprimer</a>
			</tr>	

		<?php endforeach ?>

		</table>
		
	</div>	<!-- fin presentation -->	
				

		<?php $title = 'Accueil';?>
		<?php ob_start(); ?>

		
			<div id="presentation">	 

				<h1>Présentation</h1> <br />
				
				Bienvenue sur TrocNc <br />
				Le principe de notre site est très simple: <br />
				C'est une plate-forme en ligne permettant de faire du troc, d’échanger des objets et/ou des services.<br />			

			</div>	<!-- fin presentation -->
			
				
			
			<section>	 
			
			<h1>Historique</h1> 

				<table class="reference" > 
					<tr>
						<th>Titre</th>
						<th>Annonce</th>							
					</tr>
					
				<?php foreach( $posts as $post ) : ?>
				
					<tr>
						<td> <?php echo ucfirst($post['titre']); ?></td>
						<td><?php echo ucfirst($post['description']);?></td>
					</tr>	
					
				<?php endforeach ?>

				</table>

			</section>	<!-- section -->


		
		<?php $content = ob_get_clean(); ?>
		<?php include 'layout.php'; ?>
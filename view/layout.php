<!DOCTYPE html>
<html lang="fr">
	<head>
		<link rel="stylesheet" href="/trocnc/css/troc.css">
		<title><?php echo $title; ?></title>
		<meta name="keywords" content="Page perso,Nouvelle-Calédonie,Etudiant,informatique" />
		<meta name="description" content="Accueil" />
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	</head>
	
	<body>
		<div id="global">										
			

			<!-- Menu Horizontal -->
			<nav class="principal">
			
				<ul> 
					<li>
						<form action='/troc/index.php/recherche' method='GET'>
						Recherche<input type='text'>
						<input type='submit' name='recherche' value='Search'>
					
						</form>
					</li>
					<li><a href="/troc/index.php/inscription">Connecter/Inscrire</a></li>
					 
				</ul>
			 </nav>


			<!-- Menu vertical -->
			<nav class="secondaire">
				<ul>
					<li class="bricolage"><a  href="accueil.html">Bricolage</a></li>
					<li class="jardin"><a  href="accueil.html">Jardin</a></li>
					<li class="informatique"><a  href="accueil.html">Informatique</a></li>
					<li class="tv"><a  href="accueil.html">TV/Video</a></li>
					<li class="electro"><a  href="accueil.html">Electromenager</a></li>
					<li class="auto"><a  href="accueil.html">Automobiles</a></li>
				</ul>
			</nav>
		

			<p>
				<?php
				/*if( isset($error) && $error != '' )
				{
					switch( $error ) 
					{
					
						case 'not connected':
							echo 'Veuillez svp vous authentifier';
						break;
						
						case 'bad login/pwd':
							echo 'Erreur de login et/ou de mot de passe';
						break;
					}
				}
				
				else*/if( isset($login) && $login != '' ) 
				{
					echo 'Connecté en tant que '.$login ;
					echo ' <a href="/exemple_mvc_blog/index.php/logout">Déconnexion</a>';
				}
				?>
			</p>

	<?php echo $content; ?>


			<div id="pied">
				<div id="icone">
				Coordonnées : 10 rue la_bas quelquepart dans le monde<br />
				tel : 79.74.58 <br />
				mail : trocnc@hotmail.fr <br />
				</div>	
			</div>	 <!-- fin pied -->


		</div>	<!-- fin global -->
	</body>
</html>
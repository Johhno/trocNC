<?php
// charge et initialise les bibliothèques globales
require_once 'model.php';
require_once 'controllers.php';

// démarrage de la session
session_start();

// récupération du nom de la page demandée
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$error = '';
//login = '';
$description = '';
$titre = '';
$etat = '';
$preference = '';
$categorie = '';
$email_user = '';

// vérification utilisateur authentifié
	if( !isset($_SESSION['email_user']) ) {
		if( !isset($_POST['email_user']) || !isset($_POST['password']) ) // formulaire de connexion ?
		{
			if( $uri != '/troc/index.php/inscription')
			{
				$error = 'not connected';
				$uri = '/troc/index.php' ;
			}
		}
		elseif( isset($_POST['tel']) ) // je viens du form d'inscription
		{			                   //tel ne viens que du fom d'inscription
			inscrire($_POST['email_user'],$_POST['nom'],$_POST['prenom'],$_POST['password'],$_POST['date'],$_POST['tel']);
			$email_user = $_POST['email_user'];
			$_SESSION['email_user'] = $email_user;
		}	
		elseif( !is_user($_POST['email_user'],$_POST['password']) ) // je viens du form de connexion
		{
			$error = 'bad login/pwd';		
		}
		else {
			$_SESSION['email_user'] = $_POST['email_user'] ;
			$email_user = $_SESSION['email_user'];
		}
	}
	else
		$email_user = $_SESSION['email_user'] ;

	
	// ROUTE LA REQUÊTE EN INTERNE
	if ('/troc/index.php' == $uri || '/troc/' == $uri ){	//accueil
		accueil_action($email_user,$error);
	}
	elseif ( '/troc/index.php/inscription' == $uri ){		//inscription
		inscription_action($email_user,$error);
	}
	elseif ( '/troc/index.php/blog' == $uri ){				//formulaire pour lancer une annonce
		blog_action($email_user,$error);
	}
	elseif ( '/troc/index.php/annoncer' == $uri ){			//lance une annonce
		annoncer_action($description,$titre,$etat,$preference,$categorie,$email_user,$error);
	}
	elseif ( '/troc/index.php/test1' == $uri ){			//suppression annonce
		suppri($_GET[]);
	}
	elseif ( '/troc/index.php/admin' == $uri ){			//admin 
		admin_action($_GET[]);
	}	
	elseif ( '/troc/index.php/recherche' == $uri ){		//recherche
		recherche_action($_POST['email'],$_POST['nom'],$_POST['prenom'],$_POST['passe'],$_POST['date'],$_POST['tel'],$error);
	}
	elseif('/troc/index.php/logout' == $uri ) {			//deconnexion
		// fermeture de la session
		session_destroy();
		// redirige vers la page index afin d'éviter le double clique pour se deconnecter
		header("Location: /troc/index.php");
	}
	else {
		header('Status: 404 Not Found');
		echo '<html><body><h1>My Page Not Found</h1></body>
				</html>';
	}
	
?>

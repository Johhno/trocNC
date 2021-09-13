<?php
date_default_timezone_set('Pacific/Noumea');
/* =========== SOMMAIRE ==============
-DATABASE
-GENERAL
-FONCTIONS UTILISATEUR
-FONCTIONS ADMINISTRATEUR
====================================*/

/* --------------- */
/* = Database 	   */
/* --------------- */

function open_database_connection()
{
	$link = mysqli_connect('localhost', 'root', '', 'trocnc');
	if(!$link) {
		die("La connexion à la BDD a échoué");
	}
	else{
		 
		return $link;
	}
}
	
function close_database_connection($link)
{
	mysqli_close($link);
}

function get_all_annonces()
{
	$link = open_database_connection();
	$resultall = mysqli_query($link,'SELECT titre , description , etat , preference , categorie , date_creation FROM annonce ORDER BY date_creation ASC');
	
	$annonces = array();
	
	while ($row = mysqli_fetch_assoc($resultall)) {
		$annonces[] = $row;
	}
	
	mysqli_free_result( $resultall);
	close_database_connection($link);
	return $annonces;
}


function get_all_posts() 
{		
	$link = open_database_connection();
	$resultall = mysqli_prepare($link,'SELECT titre, description FROM annonce ORDER BY date_creation DESC');

	mysqli_stmt_execute($resultall);
	
	mysqli_stmt_bind_result($resultall,$desc,$title);
	
	$posts = array();
	
	while ( mysqli_stmt_fetch($resultall)) {
		$posts[] = array('description'=>$desc,'titre'=>$title);
	}
	
	mysqli_stmt_free_result( $resultall);
	close_database_connection($link);
	return $posts;
}

function get_all_users()
{		
	$link = open_database_connection();
	$resultall = mysqli_prepare($link,'SELECT email FROM user ');

	mysqli_stmt_execute($resultall);
	
	mysqli_stmt_bind_result($resultall,$email);
	
	$users = array();
	
	while ( mysqli_stmt_fetch($resultall)) {
		$users[] = array('email'=>$email);
	}
	
	mysqli_stmt_free_result( $resultall);
	close_database_connection($link);
	return $users;
}

/* -------------- */
/* = General 	  */
/* -------------- */

//Verifie si utilisateur OU ADMIN
function is_user( $email_user, $password )
{
	$isuser = False ;
	$link = open_database_connection();
	
	$password = sha1($password);
	
	$query = mysqli_prepare($link, "SELECT niveau FROM user WHERE email=? AND password=?");
	
	mysqli_stmt_bind_param($query,'ss',$email_user,$password);		
	
	mysqli_stmt_execute($query);
	
	//which variable you'll use
	mysqli_stmt_bind_result($query,$level);
	
	$level = array();
	
	//Manage les droits
	
/* 	while(mysqli_stmt_fetch($query)){
		$level[] = array('niveau'=>$level);
		
		switch($level['niveau']){
			//cas user
			case 1:
				echo 'Yo noob'
				header('/troc/index.php/blog');
			break;
			
			//cas admin
			case 2:
				echo "C'est un honneur de vous revoir maître";
			break;
			//cas visiteur
			default:
				echo 'TOURISTE! :)';
		}
	}  */

	close_database_connection($link);

	return $isuser;
	
}

function inscrire($email,$nom,$prenom,$passe,$date,$tel){
	
	$link = open_database_connection();

	//Prepare la requete SQL                             
	
	
	$requete = mysqli_prepare($link,'INSERT INTO user VALUES( ?, ? , ? , ? , ? ,?, "1" ,"") ');
	$passe = sha1($passe);
	
	//Format DATE
	$date = strtotime($date);
	$date = date('Y-m-d',$date);
	 
	
	//Insertion des variables dans la requete
	mysqli_stmt_bind_param( $requete , 'sssssd' , $email , $nom , $prenom , $passe  , $date , $tel);
	
	mysqli_stmt_execute($requete);
	
	//Execution de la requete	
	if(mysqli_stmt_free_result($requete)){
	
		//Liberation resultat
	echo 'yo';
		
		//Liberation requete
		mysqli_stmt_close($requete);
	}	
	else
	{
		echo "L'inscription a échoué";
	}

}

/* --------------------------- */
/* = Fonctions utilisateur 	   */
/* --------------------------- */

//Publie une annonce
function annoncer($description,$titre,$etat,$preference,$categorie,$email_user){

	$link = open_database_connection();
	if(!$link) echo 'pas bon';

	//récupération des valeurs des champs:
	$description = $_POST['description']; 
	$titre = $_POST['titre']; 
	$etat = $_POST['etat']; 
	$preference = $_POST['preference']; 
	$categorie = $_POST['categorie'];
	$email_user = $_POST['email_user'];
	
	$sql = mysqli_prepare( $link,'INSERT INTO annonce VALUES("", ? , ? , ? , ? , ? , now(), ?)');
 
	mysqli_stmt_bind_param( $sql , 'ssssss' , $description,$titre,$etat,$preference,$categorie,$email_user);
	
	$result = mysqli_execute($sql);
	
	//affichage des résultats, pour savoir si l'insertion a marchée:
	if($result)
	{
		echo("L'insertion a été correctement effectuée") ; 
	}
	else
	{
		echo("L'insertion à échouée : " . mysql_error());
	}
}

function delete_annonce($id)
{
	$link = open_database_connection();
	
	$result = mysqli_query($link, 'DELETE FROM annonce WHERE id="'.$id. '"');
	
	close_database_connection($link);
}	

function get_annonces_user($email_user)
{	

	$link = open_database_connection($email_user);
	$resultall = mysqli_prepare($link,'SELECT titre,description FROM annonce , user where annonce.email_user = user.email and annonce.email_user = "' .$email_user. '"');
												
	mysqli_stmt_execute($resultall);
	
	mysqli_stmt_bind_result($resultall,$desc,$title);
	
	$posts = array();
	
	while ( mysqli_stmt_fetch($resultall)) {
		$posts[] = array('description'=>$desc,'titre'=>$title);
	}
	
	mysqli_stmt_free_result( $resultall);
	close_database_connection($link);
	return $posts;

}

function set_post( $id )
{
	$link = open_database_connection();
	$id = intval($id);
	$result = mysqli_query($link, 'SELECT * FROM Post WHERE
	id="'.$id. '"');
	$post = mysqli_fetch_assoc($result);
	mysqli_free_result( $result);
	close_database_connection($link);
	return $post;
}

function delete_post( $id )
{
	$link = open_database_connection();
	$id = intval($id);
	$result = mysqli_query($link, 'DELETE FROM post WHERE
	id="'.$id. '"');
	$post = mysqli_fetch_assoc($result);
	mysqli_free_result( $result);
	close_database_connection($link);
	return $post;
}	

function edit_profil( $id )
{
	$link = open_database_connection();
	$id = intval($id);

	//Ecriture de la requete SQL
	$requete = $link->prepare("UPDATE User SET dateNaissance=:date ,telephone=:telephone ,password=:password WHERE id=:id");

	//Insertion des variables dans la requete
	$requete->bindParam(':date',$date);		
	$requete->bindParam(':telephone',$telephone);		
	$requete->bindParam(':password',$password);		
	$requete->bindParam(':id',$id);		

	//Execution de la requete
	$requete->execute();

	//Libération de la requete
	$requete->closeCursor();
	close_database_connection($link);
}



function commenter($id){
	$link = open_database_connection();
	$date = new Date();
	$result =$link->prepare("INSERT INTO Commentaires VALUES('','','','" .$date. "','')");
}


function get_post( $id )
{
	$link = open_database_connection();
	$id = intval($id);
	$result = mysqli_query($link, 'SELECT * FROM annonce WHERE id="' .$id. '"');
	$post = mysqli_fetch_assoc($result);
	mysqli_free_result( $result);
	close_database_connection($link);
	return $post;
}

function parse_s($string){
	if(is_int($string) == true){
		echo "Entrez un nom valide."; return false; 
	}
	
	else{
		htmlentities($string);	
		return $string;		
	}
}

?>
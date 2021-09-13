<?php
//route vers la connexion
function login_action($email_user,$error)
{
	require 'view/inscription.php';
}

function layout($email_user,$error)
{
	require 'view/layout.php';
}

//route vers l'accueil
function accueil_action($email_user,$error)
{
	$posts = get_all_posts();	
	require 'view/accueil.php';
}

//liste des annonce de l'user
function annoncer_action($description,$titre,$etat,$preference,$categorie,$email_user,$error){
	annoncer($description,$titre,$etat,$preference,$categorie,$email_user);
	$posts = get_annonces_user($email_user);
	require 'view/blog.php';
}

//suppresion annonce
function supprimer_annonce($id)
{
	$posts = delete_annonce($id);
	require 'view/blog.php';
}

function blog_action($email_user,$error)
{
	$posts = get_annonces_user($email_user);
	require 'view/blog.php';
}

function annonce_action($email_user,$error)
{
	$posts = get_all_annonces();
	require 'view/accueil.php';
}

//route vers la recherche
function recherche_action($email_user,$error)
{
	$posts = recherche();
	require 'view/accueil.php';
}

function inscription_action($email,$error)
{
	require 'view/inscription.php';
}

function admin_action(){
	require 'view/admin/admin.php';
}
?>
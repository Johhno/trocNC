<?php
include './model.php';

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

$users = get_all_users();

?>

<!DOCTYPE html>
<html lang="fr">

	<head>
		<link rel="stylesheet" href="/troc/css/troc.css">
		<link rel="stylesheet" href="/troc/css/admin.css">
		<title> || Teteich ||</title>
		<meta name="keywords" content="Page perso,Nouvelle-Calédonie,Etudiant,informatique" />
		<meta name="description" content="Accueil" />
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	</head>
		
	<body>
	
		<fieldset>
			<legend>Utilisateurs</legend>
			
			<form method 'POST' action='/troc/index.php/admin'>
				<div>@mail Utilisateur:

				<select name='users'>
					<?php
					foreach ($users as $user){
						echo '<option value='. $user['email'] .'>'. $user['email'] .'</option>';
					}  
					?>
				</select>	
				</div>
				
				<div>
					<input type='button' value ='Delete' name='delete'>
					<input type='button' value ='Ajouter'name='add'>
				</div>
			</form>
		</fieldset>
	
		<fieldset>
			<legend>Categories</legend>
			
			<form method 'POST' action='/troc/index.php'>>
				
				<div>
					<select name='users'>
					<?php
					foreach ($users as $user){
						echo '<option>'. $user .'</option>';
					}
					?>
					</select>
				
					<input type='button' value ='Delete' name='delete'>
					<input type='button' value ='Ajouter'name='add'>
				</div>
			</form>
		</fieldset>
	</body>
		
</html>
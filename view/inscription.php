
		<?php $title = 'Inscription/Connexion';?>
		<?php ob_start(); ?>		

			<div id="presentation">	 
			
				
				
			
				<form action='/troc/index.php' method='post'>
					<fieldset>
						<legend>Inscription</legend>
					<div>
						<label for='email_user'>@Mail:</label>  
						<input type='text' name='email_user' required>
					</div>
					
					<div>
						<label for='login'>Nom:</label>		
						<input type='text' name='nom' required>
						<div id='login'></div>
					</div>

					<div>
						<label for='login'>Prenom:</label>		
						<input type='text' name='prenom' required>
					</div>
						
					<div>
						<label for='password'>Password</label>			
						<input type='password' name='password' required>
					</div>

					<div>
						<label for='date'>Date format--</label>			
						<input type='date' name='date' required>
					</div>

					<div>
						<label for='tel'>Telephone</label>			
						<input type='text' name='tel' required>
					</div>

					<input type="submit" value="Envoyer">
					</fieldset>

				</form>

			</div>	<!-- fin presentation -->

		
		<?php $content = ob_get_clean(); ?>
		<?php include 'layout.php'; ?>
	

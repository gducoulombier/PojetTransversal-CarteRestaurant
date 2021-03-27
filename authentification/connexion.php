<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<titre>Connexion</titre>
</head>

<body>

	<!-- Menu de navigation
	<?php include 'menu_navigation.php'; ?>
	-->

	<form method="post">
		<input type="email" name="email" id="email" placeholder="Email" required>
		<br />
		<input type="password" name="password" id="password" placeholder="Mot de passe" required>
		<br />
		<input type="submit" name="formsend" id="formsend">
	</form>
	
	<?php
		
		if(isset($_POST['formsend']))
		{
			extract($_POST);
			
			if(!empty($email) && !empty($password))
			{
				
				$option = ['cost' => 12,];
				$hashpass = password_hash($password, PASSWORD_BCRYPT, $option);
				
				include '../database.php';
				global $db;
				
				$q = $db->prepare("SELECT * FROM compte WHERE(email = :email)");
				$q->execute(['email' => $email]);
				$result = $q->fetch();

				if($result == true)
				{
					if (password_verify($password, $result['password']))
					{
						echo "CONNEXION !!!";
						$_SESSION['email'] = $email;
						$_SESSION['typeCompte'] = $result['typeCompte'];

						if ($_SESSION['typeCompte'] == 'employe')
						{
				
							$c = $db->prepare("SELECT * FROM employe WHERE(email = :email)");
							$c->execute(['email' => $email]);
							$result = $c->fetch();

							$_SESSION['nom'] = $result['nom'];
							$_SESSION['soldeCompte'] = $result['soldeCompte'];
							
						}
						elseif ($_SESSION['typeCompte'] == 'employeur')
						{
				
							$c = $db->prepare("SELECT * FROM employeur WHERE(email = :email)");
							$c->execute(['email' => $email]);
							$result = $c->fetch();

							$_SESSION['nomEntreprise'] = $result['nomEntreprise'];
							$_SESSION['siret'] = $result['siret'];
							
						}
						elseif ($_SESSION['typeCompte'] == 'commercant')
						{
				
							$c = $db->prepare("SELECT * FROM commercant WHERE(email = :email)");
							$c->execute(['email' => $email]);
							$result = $c->fetch();

							$_SESSION['nomEntreprise'] = $result['nom'];
							$_SESSION['siret'] = $result['siret'];
							
						}

					}
					else
					{
						echo "Mode de passe incorrect";
					}
				}
				else
				{
					echo "Le compte ". $email . " n'existe pas.";
				}



			}

			else
			{
				echo "Veuillez renseigner tous les champs";
			}
		}
	
	
	?>
		

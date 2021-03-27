<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<titre>Inscription - Employeur</titre>
</head>

<body>

	<!-- Menu de navigation
	<?php include 'menu_navigation.php'; ?>
	-->

	<form method="post">
		<input type="text" name="nomEntreprise" id="nomEntreprise" placeholder="Entrez le nom de votre entreprise" required>
		<br />
		<input type="text" name="siret" id="siret" placeholder="Entrez le nom de votre siret" required>
		<br />
		<input type="email" name="email" id="email" placeholder="Votre adresse Email" required>
		<br />
		<input type="password" name="password" id="password" placeholder="Votre mot de passe" required>
		<br />
		<input type="password" name="password_confirm" id="password_confirm" placeholder="Confirmez votre mot de passe" required>
		<br />
		<input type="reset" name="reset" id="reset">
		<input type="submit" name="formsend" id="formsend">
	</form>
	
	<?php
		
		if(isset($_POST['formsend']))
		{
			extract($_POST);
			
			if(!empty($email) && !empty($password) && $password_confirm==$password)
			{

				include '../../database.php';
				global $db;

				$option = ['cost' => 12,];
				$hashpass = password_hash($password, PASSWORD_BCRYPT, $option);
				
				$c = $db->prepare("SELECT email FROM compte WHERE email = :email");
				$c->execute(['email' => $email]);
				$result = $c->rowCount();

				if($result == 0)
				{

					$q = $db->prepare("INSERT INTO compte(email, password, typeCompte) VALUES(:email, :password, 'employeur')");
					$q->execute(
					[
						'email' => $email,
						'password' => $hashpass
					]);

					$_SESSION['email'] = $email;
					$_SESSION['nomEntreprise'] = $nomEntreprise;
					$_SESSION['siret'] = $siret;

					echo "Le compte a bien été créé";
					sleep(2);

					header('Location: information.php');
					exit();
				}

				else
				{
					echo "Ce compte existe deja";
				}
			}

			elseif($password!=$password_confirm)
			{
				echo "Veillez saisir un mot de passe et une confirmation de mot de passe identiques";
			}
			else
			{
				echo "Veuillez renseigner tous les champs";
			}
		}
	
	
	?>
		

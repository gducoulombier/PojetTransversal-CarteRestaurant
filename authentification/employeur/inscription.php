<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../../css/w3.css">
	<link rel="stylesheet" href="../../css/poppins.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

	<div class="w3-bar w3-red">
		<a class="w3-bar-item w3-button fa fa-home" href="../../index.php"> Home</a>
	</div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:40px;margin-right:40px">

  <!-- Header / Solde -->
  <div class="w3-container" style="margin-top:20px" id="showcase">
    <h1 class="w3-xxxlarge"><b>Inscription</b></h1>
    <hr style="width:50px;border:5px solid red" class="w3-round">
  </div>

  <!-- Menu inscription -->

<form method="post" class="w3-container w3-card-4 w3-light-grey">
  <p>      
  <label>Nom de votre entreprise</label>
  <input type="text" name="nomEntreprise" id="nomEntreprise" class="w3-input w3-border" required>
  </p>
  <p>      
  <label>Votre numero de SIRET</label>
  <input type="text" name="siret" id="siret" class="w3-input w3-border" required>
  </p>
  <p>
  <label>Votre adresse Email</label>	
  <input type="email" name="email" id="email" class="w3-input w3-border" required>
  </p>
  <p>
  <label>Votre mot de passe</label>	
  <input type="password" name="password" id="password" class="w3-input w3-border" required>
  </p>
  <p>
  <label>Confirmation du mot de passe</label>	
  <input type="password" name="password_confirm" id="password_confirm" class="w3-input w3-border" required>
  </p>
  <p>
  <input class="w3-button w3-grey w3-padding-large" type="reset" name="reset" id="reset">
  <input class="w3-button w3-red w3-padding-large w3-hover-black" type="submit" name="formsend" id="formsend">
  </p>
</form>

  <!-- Traitement -->
	
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

					header('Location: inscription-information.php');
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
	
</div>
</body>
</html>	

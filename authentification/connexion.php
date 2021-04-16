<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../css/w3.css">
	<link rel="stylesheet" href="../css/poppins.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

	<div class="w3-bar w3-red">
		<a class="w3-bar-item w3-button fa fa-home" href="../index.php"> Home</a>
	</div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:40px;margin-right:40px">

  <!-- Header / Solde -->
  <div class="w3-container" style="margin-top:20px" id="showcase">
    <h1 class="w3-xxxlarge"><b>Connexion</b></h1>
    <hr style="width:50px;border:5px solid red" class="w3-round">
  </div>

  <!-- Menu connexion -->

<form method="post" class="w3-container w3-card-4 w3-light-grey">
  <p>      
  <label>Email</label>
  <input type="email" name="email" id="email" class="w3-input w3-border" required>
  </p>
  <p>      
  <label>Mot de passe</label>
  <input type="password" name="password" id="password" class="w3-input w3-border" required>
  </p>
  <p>
  <a href="mdp-oublie.php" class="w3-right">Mot de passe oublié</a>
  </p>
  <p>
  <input class="w3-button w3-red w3-padding-large w3-hover-black" type="submit" name="formsend" id="formsend">
  </p>
</form>


  <!-- Traitement Connexion -->


<br>
	
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

							$_SESSION['idEmploye'] = $result['idEmploye'];
							$_SESSION['nom'] = $result['Nom'];
							$_SESSION['soldeCompte'] = $result['SoldeCompte'];
							$_SESSION['adresse'] = $result['Adresse'];
							$_SESSION['RIB'] = $result['RIB'];
							$_SESSION['dateNaissance'] = $result['DateNaissance'];
							$_SESSION['gain'] = 0;

							header('Location: employe/index-employe.php');
							
						}
						elseif ($_SESSION['typeCompte'] == 'employeur')
						{
				
							$c = $db->prepare("SELECT * FROM employeur WHERE(email = :email)");
							$c->execute(['email' => $email]);
							$result = $c->fetch();

							$_SESSION['nomEntreprise'] = $result['NomEntreprise'];
							$_SESSION['SIRET'] = $result['SIRET'];
							$_SESSION['idEmployeur'] = $result['idEmployeur'];
							$_SESSION['adresse'] = $result['Adresse'];
							$_SESSION['pourcentage'] = $result['PourcentageDefaut'];
							$_SESSION['RIB'] = $result['RIB'];

							
							header('Location: employeur/index-employeur.php');

						}
						elseif ($_SESSION['typeCompte'] == 'commercant')
						{
				
							$c = $db->prepare("SELECT * FROM commercant WHERE(email = :email)");
							$c->execute(['email' => $email]);
							$result = $c->fetch();

							$_SESSION['nomEntreprise'] = $result['Nom'];
							$_SESSION['SIRET'] = $result['SIRET'];
							$_SESSION['adresse'] = $result['Adresse'];
							$_SESSION['RIB'] = $result['RIB'];
							

							header('Location: commercant/index-commercant.php');

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
		
</body>
</html>
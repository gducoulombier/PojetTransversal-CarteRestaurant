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
    <h1 class="w3-xxxlarge"><b>Mot de passe oublié</b></h1>
    <hr style="width:50px;border:5px solid red" class="w3-round">
  </div>

  <!-- Menu connexion -->

<form method="post" class="w3-container w3-card-4 w3-light-grey">
  <p>      
  <label>Email</label>
  <input type="email" name="email" id="email" class="w3-input w3-border" required>
  </p>
  <p>
  <input class="w3-button w3-red w3-padding-large w3-hover-black" type="submit" name="formsend" id="formsend" value="Récupération du compte">
  </p>
</form>


  <!-- Traitement -->
	
	<?php
		
		if(isset($_POST['formsend']))
		{
			extract($_POST);
			
			if(!empty($email))
			{
				
				include '../database.php';
				global $db;
				
				$q = $db->prepare("SELECT * FROM compte WHERE(email = :email)");
				$q->execute(['email' => $email]);
				$result = $q->fetch();

				if($result == true)
				{

					header('Location: mdp-envoye.php');
							
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
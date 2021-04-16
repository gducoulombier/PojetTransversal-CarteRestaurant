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
    <h1 class="w3-xxxlarge"><b>Informations</b></h1>
    <hr style="width:50px;border:5px solid red" class="w3-round">
  </div>

  <!-- Menu inscription -->

<form method="post" class="w3-container w3-card-4 w3-light-grey">
  <p>      
  <label>Adresse postale de votre entreprise :</label>
  <input type="text" name="adresse" id="adresse" class="w3-input w3-border" required>
  </p>
  <p>
  <label>RIB</label>	
  <input type="text" name="rib" id="rib" class="w3-input w3-border" required>
  </p>
  <p>
  <label>Date de premier prélèvement</label>	
  <input type="date" name="datePrelevement" id="datePrelevement" class="w3-input w3-border" required>
  </p>
  <p>
  <label>Pourcentage de prise en charge par défaut de l'entreprise :</label>	
  <input type="text" name="PourcentageDefaut" id="PourcentageDefaut" class="w3-input w3-border" required>
  </p>
  <p>
  <input class="w3-button w3-grey w3-padding-large" type="reset" name="reset" id="reset">
  <input class="w3-button w3-red w3-padding-large w3-hover-black" type="submit" name="formsend" id="formsend">
  </p>
</form>
	
  <!-- Traitement informations -->

	<?php
		
		if(isset($_POST['formsend']))
		{
			extract($_POST);
			
			if(!empty($adresse) && !empty($rib) && !empty($datePrelevement) && !empty($PourcentageDefaut) && ($PourcentageDefaut < 100 && $PourcentageDefaut > 0))
			{

				include '../../database.php';
				global $db;

				$q = $db->prepare("INSERT INTO employeur(email, nomEntreprise, adresse, SIRET, rib, PourcentageDefaut, datePrelevement) VALUES(:email, :nomEntreprise, :adresse, :siret, :rib, :PourcentageDefaut, :datePrelevement)");
				$q->execute(
				[
					'email' => $_SESSION['email'],
					'nomEntreprise' => $_SESSION['nomEntreprise'],
					'adresse' => $adresse,
					'siret' => $_SESSION['siret'],
					'rib' => $rib,
					'PourcentageDefaut' => $PourcentageDefaut,
					'datePrelevement' => $datePrelevement
				]);

				echo "Informations validés";
				sleep(2);

				header('Location: commande-carte.php');
				exit();
			}

			elseif ($PourcentageDefaut > 100)
			{
				echo "Le pourcentage de prise en charge de l'entreprise est supérieur à 100%";
			}

			elseif ($PourcentageDefaut > 0)
			{
				echo "Un pourcentage de prise en charge de l'entreprise négatif est impossible";
			}

			else
			{
				echo "Veuillez renseigner tous les champs";
			}
		}
	
	
	?>
		

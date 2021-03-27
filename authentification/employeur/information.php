<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<titre>Informations</titre>
</head>

<body>

	<!-- Menu de navigation
	<?php include 'menu_navigation.php'; ?>
	-->

	<form method="post">
		Adresse postale de votre entreprise :
		<input type="text" name="adresse" id="adresse" placeholder="adresse" required>
		<br />
		Votre RIB : 
		<input type="text" name="rib" id="rib" placeholder="RIB" required>
		<br />
		Date du premier prélèvement mensuel : 
		<input type="date" name="datePrelevement" id="datePrelevement" required>
		<br />
		Pourcentage de prise en charge de l'entreprise :
		<input type="text" name="PourcentageDefaut" id="PourcentageDefaut" placeholder="PourcentageDefaut" required>
		<br />
		<input type="reset" name="reset" id="reset">
		<input type="submit" name="formsend" id="formsend">
	</form>
	
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

				header('Location: index-employeur.php');
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
		

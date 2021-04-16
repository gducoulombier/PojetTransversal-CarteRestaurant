<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<titre>Commande de cartes</titre>
</head>

<body>

	<!-- Menu de navigation
	<?php include 'menu_navigation.php'; ?>
	-->

	<form method="post">
		Nombre de cartes à commander :
		<input type="text" name="nbreCarte" id="nbreCarte" placeholder="nbreCarte" required>
		<br />
		<input type="submit" name="formsend" id="formsend">
	</form>
	
	<?php
		
		if(isset($_POST['formsend']))
		{
			extract($_POST);
			
			if(!empty($nbreCarte) && $nbreCarte > 0))
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
		

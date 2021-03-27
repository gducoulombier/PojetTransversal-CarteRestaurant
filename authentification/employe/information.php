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
		Votre nom : 
		<input type="text" name="nom" id="nom" placeholder="Nom" required>
		<br />
		Votre Entreprise : 
		<input type="text" name="nomEntreprise" id="nomEntreprise" placeholder="Nom de l'entreprise" required>
		<br />
		Votre adresse postale :
		<input type="text" name="adresse" id="adresse" placeholder="Adresse postale" required>
		<br />
		Votre date de naissance : 
		<input type="date" name="dateDeNaissance" id="dateDeNaissance" required>
		<br />
		Votre RIB : 
		<input type="text" name="rib" id="rib" placeholder="RIB" required>
		<br />
		Date du premier prélèvement mensuel : 
		<input type="date" name="datePrelevement" id="datePrelevement" required>
		<br />
		<input type="reset" name="reset" id="reset">
		<input type="submit" name="formsend" id="formsend">
	</form>
	
	<?php
		
		if(isset($_POST['formsend']))
		{
			extract($_POST);
			
			if(!empty($nom) && !empty($nomEntreprise) && !empty($adresse) && !empty($dateDeNaissance) && !empty($rib))
			{

				include '../../database.php';
				global $db;
			
				$c = $db->prepare("SELECT * FROM employeur WHERE(nomEntreprise = :nomEntreprise)");
				$c->execute(['nomEntreprise' => $nomEntreprise]);
				$result = $c->fetch();

				if ($result == true)
				{
					$pourcentageEmployeur = $result['PourcentageDefaut'];

					echo "Date de naissance : " . $dateDeNaissance;

					// Remplir la base employe
					$q = $db->prepare("INSERT INTO employe(email, nom, adresse, dateNaissance, rib, soldeCompte, PourcentageEmployeur, datePrelevement) VALUES(:email, :nom, :adresse, :dateDeNaissance, :rib, '0', :PourcentageEmployeur, :datePrelevement)");
					$q->execute(
					[
						'email' => $_SESSION['email'],
						'nom' => $nom,
						'adresse' => $adresse,
						'dateDeNaissance' => $dateDeNaissance,
						'rib' => $rib,
						'PourcentageEmployeur' => $pourcentageEmployeur,
						'datePrelevement' => $datePrelevement
					]);

					echo "Informations validés";
					sleep(2);

					header('Location: index-employe.php');
					exit();
				}
				else
				{
					echo "Le nom de votre entreprise n'est pas valide";
				}
			}

			else
			{
				echo "Veuillez renseigner tous les champs";
			}
		}
	
	
	?>
		

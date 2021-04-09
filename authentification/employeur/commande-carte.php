<?php session_start();
	$prixCarte = 5;
 ?>

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
			
			if(!empty($nbreCarte) && $nbreCarte > 0 && $nbreCarte=abs($nbreCarte))
			{

				include '../../database.php';
				global $db;

				$r = $db->prepare("SELECT * FROM employeur WHERE(email = :email)");
				$r->execute(['email' => $_SESSION['email']]);
				$result = $r->fetch();

				$_SESSION['idEmployeur'] = $result['idEmployeur'];

				if($result == true)
				{
					$q = $db->prepare("INSERT INTO commande(idEmployeur, nbCartes) VALUES(:idEmployeur, :nbCartes)");
					$q->execute(
					[
						'idEmployeur' => $_SESSION['idEmployeur'],
						'nbCartes' => $nbreCarte
					]);

					for($i = 1; $i <= $nbreCarte; $i++)
					{
						$e = $db->prepare("INSERT INTO cartes(idEmployeur, idEmploye) VALUES(:idEmployeur, 0)");
						$e->execute(
						[
							'idEmployeur' => $_SESSION['idEmployeur']
						]);
					}

				
					$r = $db->prepare("SELECT MAX(idCommande) FROM commande");
					$r->execute();
					$result = $r->fetch();

					$Montant = $nbreCarte * $prixCarte;

					$e = $db->prepare("INSERT INTO factures(idCommande, Montant) VALUES(:idCommande, :Montant)");
					$e->execute(
					[
						'idCommande' => $result['MAX(idCommande)'],
						'Montant' => $Montant
					]);



					echo "Commande validée";
					sleep(2);

					header('Location: index-employeur.php');
					exit();

				}

			}

			else
			{
				echo "Veuillez renseigner tous les champs";
			}
		}
	
	
	?>
		

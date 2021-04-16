<?php session_start();
	$prixCarte = 5;
 ?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
   
    <?php include 'menu-employeur.php'; ?>
    <meta http-quiv="Content-Type" content="text/html;charset=utf-8"/>
    
</head>

<body>
<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:40px;margin-right:40px">

  <!-- Header / Solde -->
    <div class="w3-container" style="margin-top:20px" id="showcase">
        <h1 class="w3-xxxlarge w3-text-red"><b>Commande de cartes</b></h1>
        <hr style="width:50px;border:5px solid red" class="w3-round">
    </div>


  <!-- Commande -->
  	<br />
	<form method="post">
		Prix unitaire d'une carte : <?php echo $prixCarte; ?> €
		<br />
		Nombre de cartes à commander :
		<input type="text" name="nbreCarte" id="nbreCarte" required>
		<br />
		<br />
		<br />
		<input type="submit" name="formsend" id="formsend" class="w3-button w3-red" value="Commander">
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


					header('refresh:1; URL=commande-valide.php');
					exit();

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
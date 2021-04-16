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
  <label>Nom</label>
  <input type="text" name="nom" id="nom" class="w3-input w3-border" required>
  </p>
  <p>      
  <label>Votre entreprise</label>
  <input type="text" name="nomEntreprise" id="nomEntreprise" class="w3-input w3-border" required>
  </p>
  <p>
  <label>Votre adresse postale</label>	
  <input type="text" name="adresse" id="adresse" class="w3-input w3-border" required>
  </p>
  <p>
  <label>Date de naissance</label>	
  <input type="date" name="dateDeNaissance" id="dateDeNaissance" class="w3-input w3-border" required>
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
  <input class="w3-button w3-grey w3-padding-large" type="reset" name="reset" id="reset">
  <input class="w3-button w3-red w3-padding-large w3-hover-black" type="submit" name="formsend" id="formsend">
  </p>
</form>



  <!-- Traitement informations -->
	
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


					$r = $db->prepare("SELECT MAX(idEmploye) FROM employe");
					$r->execute();
					$result = $r->fetch();

					/* $q = $db->prepare("UPDATE cartes SET idEmploye=" . $result['MAX(idEmploye)'] ." WHERE idCarte = " . $_SESSION['idCarte']); */
					$q = $db->prepare("UPDATE cartes SET idEmploye=:idEmploye WHERE idCarte =:idCarte ");
					$q->bindParam(':idEmploye', $result['MAX(idEmploye)'], PDO::PARAM_INT);
					$q->bindParam(':idCarte', $_SESSION['idCarte'], PDO::PARAM_INT);
					$q->execute();

					
					$_SESSION['nom'] = $nom;
					$_SESSION['nomEntreprise'] = $nomEntreprise;
					$_SESSION['soldeCompte'] = 0;
					$_SESSION['adresse'] = $adresse;
					$_SESSION['RIB'] = $rib;
					$_SESSION['dateNaissance'] = $dateDeNaissance;
					$_SESSION['gain'] = 0;
					

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
		

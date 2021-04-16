<?php session_start(); ?>

<!DOCTYPE html>
<html>

<head>
   
    <?php include 'menu-employe.php'; ?>
    <meta http-quiv="Content-Type" content="text/html;charset=utf-8"/>
    
</head>

<body>
<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:40px;margin-right:40px">

  <!-- Header / Solde -->
    <div class="w3-container" style="margin-top:20px" id="showcase">
        <h1 class="w3-xxxlarge w3-text-red"><b>Bravo !</b></h1>
        <hr style="width:50px;border:5px solid red" class="w3-round">
    </div>

  <?php $newSolde = $_SESSION['soldeCompte']+1; ?>

  <!-- Mise a jour -->

  <?php

  	if(empty($_SESSION['gain']))
  	{

    	echo "Félicitation ! Vous venez de gagner à un jeu sponsorisé.";
  		echo "Votre solde va être crédité de 1€ et passe de ". $_SESSION['soldeCompte']." € à " . $newSolde. " €.";

  		include '../../database.php';
  		global $db;

		$requete = $db->prepare('UPDATE employe SET SoldeCompte=:nouveauSolde WHERE idEmploye=:id');
        $requete->bindParam(':id',$_SESSION['idEmploye'] , PDO::PARAM_INT);
        $requete->bindParam(':nouveauSolde',$newSolde , PDO::PARAM_STR);
        $requete->execute();

    	$_SESSION['soldeCompte'] = $newSolde;
    	$_SESSION['gain']=1;

    	header('refresh:5; URL=index-employe.php');
	
	}

	else
	{
		echo "Vous avez déjà jouer aujourd'hui ! Vous pourrez rejouer demain :)";

		header('refresh:5; URL=index-employe.php');

	}

  ?>

</body>
</html>


</html>
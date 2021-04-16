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

<body class="w3-black">

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:40px;margin-right:40px">

  <!-- Header / Solde -->

  <div class="w3-container" style="margin-top:20px" id="showcase">
    <h1 class="w3-xxxlarge"><b>Banque</b></h1>
    <hr style="width:50px;border:5px solid white" class="w3-round">
  </div>


  <!-- Menu connexion -->

<div class="w3-container w3-light-grey">
  <h2>Paiements</h2>
</div>

<form method="post" class="w3-container w3-card-4 w3-light-grey">
  <p>      
  <label>Numero de carte</label>
  <input type="text" name="NumeroCarte" id="NumeroCarte" class="w3-input w3-border" required>
  </p>
  <p>      
  <label>Numero de terminal</label>
  <input type="text" name="NumeroTerminal" id="NumeroTerminal" class="w3-input w3-border" required>
  </p>
  <p>
  <p>      
  <label>Montant</label>
  <input type="text" name="Montant" id="Montant" class="w3-input w3-border" required>
  </p>
  <p>
  <input class="w3-button w3-black w3-padding-large w3-hover-black" type="submit" name="formsend" id="formsend">
  </p>
</form>


  <!-- Traitement des données -->


  <?php
  include '../database.php';
  global $db;

  include '../database-bank.php';
  global $dbBank;

  if(isset($_POST['formsend']))
  { 
    extract($_POST);
    if(!empty($NumeroCarte) && !empty($NumeroTerminal && !empty($Montant)) ){
      

      $requete = $db->prepare('SELECT e.idEmploye FROM cartes c, employe e WHERE :id = c.idCarte AND c.idEmploye=e.idEmploye');
      $requete->bindParam(':id',$NumeroCarte , PDO::PARAM_INT);
      $requete->execute();
      $tab1=$requete->fetch();
      $idEmploye=$tab1[0];

      $requete2 = $db->prepare('SELECT c.idCommercant FROM terminal t , commercant c WHERE :id = t.idTerminal AND c.idCommercant=t.idCommercant');
      $requete2->bindParam(':id',$NumeroTerminal , PDO::PARAM_INT);
      $requete2->execute();
      $tab2=$requete2->fetch();
      $idCommercant=$tab2[0];

      $requete3 = $db->prepare('SELECT e.SoldeCompte FROM  employe e WHERE :id = idEmploye');
      $requete3->bindParam(':id',$idEmploye , PDO::PARAM_INT);
      $requete3->execute();
      $tab3=$requete3->fetch();
      $SoldeEmploye=$tab3[0];

      $requete4 = $db->prepare('SELECT c.RIB FROM commercant c WHERE :id = idCommercant');
      $requete4->bindParam(':id',$idCommercant , PDO::PARAM_INT);
      $requete4->execute();
      $tab4=$requete4->fetch();
      $RIBCommercant=$tab4[0];

      $requete5 = $dbBank->prepare('SELECT c.Solde FROM compte c WHERE :RIB = c.RIB');
      $requete5->bindParam(':RIB',$RIBCommercant , PDO::PARAM_STR);
      $requete5->execute();
      $tab5=$requete5->fetch();
      $SoldeCommercant=$tab5[0];

      
      if ( $SoldeEmploye>$Montant){
        $SoldeApresDebit = $SoldeEmploye - $Montant;
        $SoldeApresCredit = $SoldeCommercant + $Montant;

        $requete6 = $db->prepare('UPDATE employe SET SoldeCompte=:SoldeApresDebit WHERE idEmploye=:id');
        $requete6->bindParam(':id',$idEmploye , PDO::PARAM_INT);
        $requete6->bindParam(':SoldeApresDebit',$SoldeApresDebit , PDO::PARAM_STR);
        $requete6->execute();

        $requete7 = $dbBank->prepare('UPDATE compte SET Solde=:SoldeApresCredit WHERE :RIBCommercant=RIB');
        $requete7->bindParam(':RIBCommercant',$RIBCommercant , PDO::PARAM_STR);
        $requete7->bindParam(':SoldeApresCredit',$SoldeApresCredit , PDO::PARAM_STR);
        $requete7->execute();

        $requete8 = $db->prepare("INSERT INTO transactions(idCarte,idTerminal,Montant,Date) Values (:idCarte,:idTerminal, :Montant, CURRENT_TIMESTAMP) ");
        $requete8->bindParam(':idCarte',$NumeroCarte , PDO::PARAM_INT);
        $requete8->bindParam(':idTerminal',$NumeroTerminal , PDO::PARAM_INT);
        $requete8->bindParam(':Montant',$Montant , PDO::PARAM_STR);
        $requete8->execute();


        echo "Paiement accepté";
      }else{
        echo "Paiement refusé";
      }

    }else{
      echo "Fatal error abort transaction"; 
    }

  }





?>



    
</body>
</html>
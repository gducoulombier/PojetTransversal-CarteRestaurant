<?php session_start(); ?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
   
	<?php include 'menu-commercant.php'; ?>
    <meta http-quiv="Content-Type" content="text/html;charset=utf-8"/>
    <link rel='stylesheet' type='text/css' href='../../css/jauge-circulaire.css' />
    
</head>

<body>
<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:40px;margin-right:40px">

  <!-- Header / Solde -->
  <div class="w3-container" style="margin-top:20px" id="showcase">
    <h1 class="w3-jumbo"><b>Bonjour <?php echo $_SESSION['nomEntreprise']; ?></b></h1>
    <hr style="width:50px;border:5px solid red" class="w3-round">
  </div>



  <!-- Transactions -->
  <?php
    include '../../database.php';
    global $db;

    $requete1 = $db->prepare("SELECT com.idCommercant FROM commercant com, compte c WHERE c.Email=:email AND c.Email=com.Email");
    $requete1->bindParam(':email', $_SESSION['email'], PDO::PARAM_STR);
    $requete1->execute();
    $tab1=$requete1->fetch();
    $idCommercant=$tab1[0];

    $requete2 = $db->prepare("SELECT  SUM(t.Montant)  FROM transactions t, terminal ter WHERE :idCommercant=ter.idCommercant  AND ter.idTerminal=t.idTerminal");
    $requete2->bindParam(':idCommercant', $idCommercant, PDO::PARAM_INT);
    $requete2->execute();
    $tab2=$requete2->fetch();
    $MontantTotal=$tab2[0];
    
    if(empty($MontantTotal))
    {
        $MontantTotal=0;
    }
    

    ?>

   <div class="w3-xlarge w3-text-red"><b>Revenus apportés par le service WineMoreTime : <?php echo $MontantTotal ?> € </b></div>
   <br /> 


</body>

    
</html>

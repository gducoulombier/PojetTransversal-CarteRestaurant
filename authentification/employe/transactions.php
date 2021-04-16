<?php session_start(); ?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
   
    <?php include 'menu-employe.php'; ?>
    <meta http-quiv="Content-Type" content="text/html;charset=utf-8"/>
    
</head>

<body>
<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:40px;margin-right:40px">

  <!-- Header / Solde -->
    <div class="w3-container" style="margin-top:20px" id="showcase">
        <h1 class="w3-xxxlarge w3-text-red"><b>Vos transactions</b></h1>
        <hr style="width:50px;border:5px solid red" class="w3-round">
    </div>

  <!-- Transactions -->
  <?php
    include '../../database.php';
    global $db;

    $requete1 = $db->prepare("SELECT e.idEmploye FROM employe e, compte c WHERE c.Email=:email AND c.Email=e.Email");
    $requete1->bindParam(':email', $_SESSION['email'], PDO::PARAM_STR);
    $requete1->execute();
    $tab1=$requete1->fetch();
    $idEmploye=$tab1[0];

    $requete2 = $db->prepare("SELECT c.Nom, t.Montant, t.Date, t.idTransaction FROM transactions t, commercant c, cartes car, terminal ter WHERE car.idEmploye=:idEmploye AND c.idCommercant=ter.idCommercant AND car.idCarte=t.idCarte AND ter.idTerminal=t.idTerminal");
    $requete2->bindParam(':idEmploye', $idEmploye, PDO::PARAM_INT);
    $requete2->execute();
    
    
    ?>

    <table class="w3-table w3-striped w3-centered w3-hoverable w3-bordered">
                <tr>
                    <th>Numero de Transaction</th>
                    <th>Nom du Commercant</th>
                    <th>Montant de la transaction</th>
                    <th>Date de la transaction</th>
                </tr>
                <?php
            while($donnees=$requete2->fetch())
            {
            ?>
                <tr>
                  <td><?php echo $donnees['idTransaction'];?></td>
                    <td><?php echo $donnees['Nom'];?></td>
                    <td><?php echo $donnees['Montant'];?></td>
                    <td><?php echo $donnees['Date'];?></td>
                    
                </tr>
            <?php
                
            }
            ?>
    </table>



</body>
</html>
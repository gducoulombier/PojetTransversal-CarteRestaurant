<?php session_start();
  $today = date("Y-m-d H:i:s");
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
        <h1 class="w3-xxxlarge w3-text-red"><b>Suivi des commandes</b></h1>
        <hr style="width:50px;border:5px solid red" class="w3-round">
    </div>


  <!-- Liste des commandes -->

  <?php

    include '../../database.php';
    global $db;

    $q = $db->prepare("SELECT idCommande, nbCartes, dateCommande FROM commande WHERE idEmployeur=:id");
    $q->bindParam(':id', $_SESSION['idEmployeur'], PDO::PARAM_INT);
    $q->execute();
    $nbLigne=$q->rowCount();

  ?>

  <!-- Creation du tableau -->

        <form method="post">
        <table class="w3-table w3-striped w3-centered w3-hoverable w3-bordered">
                <tr>
                    <th>Numéro de commande</th>
                    <th>Nombre de cartes</th>
                    <th>Montant</th>
                    <th>Date de commande</th>
                    <th>Statut</th>
                </tr>
                
                <?php

            while($donnees=$q->fetch())
            {
                
            ?>
                <tr>
                    <td><?php echo $donnees['idCommande'];?></td>
                    <td><?php echo $donnees['nbCartes'];?></td>
                    <td><?php echo $donnees['nbCartes']*$prixCarte." €";?></td>
                    <td><?php echo $donnees['dateCommande'];?></td>
                    <td><?php 
                    $d1 = $today;
                    $d2 = $donnees['dateCommande'];
                    $tmstp1 = strtotime($d1);
                    $tmstp2 = strtotime($d2);
                    if($tmstp2 < $tmstp1-500000)
                    {
                      echo "Commande reçue";
                    }
                    elseif($tmstp2 < $tmstp1-250000)
                    {
                      echo "Commande envoyée";
                    }
                    else
                    {
                      echo "Commande en cours de traitement";
                    }

                    ?></td>
                    
                </tr>
            <?php
                
            }
            ?>
        </table>
        </form>
		
</body>
</html>
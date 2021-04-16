<?php session_start(); ?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
   
    <?php include 'menu-commercant.php'; ?>
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

    $requete1 = $db->prepare("SELECT com.idCommercant FROM commercant com, compte c WHERE c.Email=:email AND c.Email=com.Email");
    $requete1->bindParam(':email', $_SESSION['email'], PDO::PARAM_STR);
    $requete1->execute();
    $tab1=$requete1->fetch();
    $idCommercant=$tab1[0];

    $requete2 = $db->prepare("SELECT  t.Montant, t.Date, t.idTransaction FROM transactions t, terminal ter WHERE :idCommercant=ter.idCommercant  AND ter.idTerminal=t.idTerminal");
    $requete2->bindParam(':idCommercant', $idCommercant, PDO::PARAM_INT);
    $requete2->execute();


    $requete3 = $db->prepare("SELECT  SUM(t.Montant)  FROM transactions t, terminal ter WHERE :idCommercant=ter.idCommercant  AND ter.idTerminal=t.idTerminal");
    $requete3->bindParam(':idCommercant', $idCommercant, PDO::PARAM_INT);
    $requete3->execute();
    $tab2=$requete3->fetch();
    $MontantTotal=$tab2[0];
    
    if(empty($MontantTotal))
    {
        $MontantTotal=0;
    }
    

    ?>

   <div>Revenus apportés par le service WineMoreTime : <?php echo $MontantTotal ?> € </div>
   <br /> 

    <table class="w3-table w3-striped w3-centered w3-hoverable w3-bordered">
                <tr>
                    <th>Numero de transaction</th>
                    <th>Montant de la transaction</th>
                    <th>Date de la transaction</th>
                </tr>
                <?php
            while($donnees=$requete2->fetch())
            {
            ?>
                <tr>
                  <td><?php echo $donnees['idTransaction'];?></td>
                    <td><?php echo $donnees['Montant'];?></td>
                    <td><?php echo $donnees['Date'];?></td>
                    
                </tr>
            <?php
                
            }
            ?>
        </table>    

</body>
</html>
<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
   
<?php include 'menu-employeur.php'; ?>
    
</head>

<body>
<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:40px;margin-right:40px">

  <!-- Header / Solde -->
  <div class="w3-container" style="margin-top:20px" id="showcase">
    <h1 class="w3-jumbo"><b>Bonjour <?php echo $_SESSION['nomEntreprise']; ?></b></h1>
    <h1 class="w3-xxlarge w3-text-red"><b>Vous être connecté avec un compte entreprise</b></h1>
    <hr style="width:50px;border:5px solid red" class="w3-round">
  </div>


    <!-- Consultation de la BD -->

    <?php
    include '../../database.php';
    global $db;

    $q = $db->prepare("SELECT e.idEmploye, e.Nom, e.PourcentageEmployeur FROM employe e, cartes c WHERE c.idEmployeur=:id AND c.idEmploye=e.idEmploye");
    $q->bindParam(':id', $_SESSION['idEmployeur'], PDO::PARAM_INT);
    $q->execute();
    $nbLigne=$q->rowCount();
    
    ?>


    <!-- Creation du tableau -->

        <form method="post">
        <table class="w3-table w3-striped w3-centered w3-hoverable w3-bordered">
                <tr>
                    <th>ID de l'Employe</th>
                    <th>Nom de l'Employe</th>
                    <th>Pourcentage attribué</th>
                </tr>
                <?php
            $pourcentage=0;
            while($donnees=$q->fetch())
            {
                
                $tab[] = $donnees['idEmploye']
            ?>
                <tr>
                    <td><?php echo $donnees['idEmploye'];?></td>
                    <td><?php echo $donnees['Nom'];?></td>
                    <td><input type='text' class="w3-center" name=<?php echo $pourcentage ?> id=<?php echo $pourcentage ?>   value=<?php echo $donnees['PourcentageEmployeur'];?> class='PourcentageEmployeur' data-min='0' data-max='100' /></td>
                    
                </tr>
            <?php
                
                $pourcentage=$pourcentage+1;
            }
            ?>
        </table>
        <br />
        <input type="submit" name="formsend" id="formsend" class="w3-button w3-white w3-border w3-border-red w3-round-large" value="Valider les pourcentages">
        </form>
        

    <!-- Update de la BD -->


        <?php
        if(isset($_POST['formsend']))
        {
            $compteur=0; 
            while($compteur!=$nbLigne)
            {  
                extract($_POST);
                
                /*
                echo $_POST[$compteur].", ";
                echo $tab[$compteur]."; ";
                */

                if(!empty($_POST[$compteur]))
                {
                    
                    $q2=$db->prepare("UPDATE employe SET PourcentageEmployeur=:PourcentageEmployeur WHERE idEmploye=:idEmploye");
                    $q2->bindParam(':PourcentageEmployeur', $_POST[$compteur] , PDO::PARAM_INT);
                    $q2->bindParam(':idEmploye',$tab[$compteur], PDO::PARAM_INT);
                    $q2->execute();

                }

            $compteur=$compteur+1; 
            }

        header('Location: index-employeur.php');

        }

        ?>
 </body>   
</html>

<?php session_start(); ?>

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
        <h1 class="w3-xxxlarge w3-text-red"><b>Modifier votre nom d'entreprise</b></h1>
        <hr style="width:50px;border:5px solid red" class="w3-round">
    </div>

  <!-- Menu modification -->

<p>Votre adresse actuelle : <?php echo $_SESSION['nomEntreprise'] ?></p><br />

<form method="post" class="w3-container w3-card-4 w3-light-grey">
  <p>      
  <label>Veuillez saisir le nouveau nom de votre entreprise : </label>
  <input type="text" name="nom" id="nom" class="w3-input w3-border" required>
  </p>
  <p>
  <input class="w3-button w3-red w3-padding-large w3-hover-black" type="submit" name="formsend" id="formsend">
  </p>
</form>

  <!-- Traitement -->

<?php
    if(isset($_POST['formsend'])){
        
        extract($_POST); 
        if(!empty($nom)){
            include '../../database.php';
			global $db;

            $requete1 = $db->prepare('SELECT idEmployeur FROM compte c , employeur e  WHERE c.Email = :email AND c.Email=e.Email');
            $requete1->bindParam(':email', $_SESSION['email'], PDO::PARAM_STR );
            $requete1->execute();
            $id=$requete1->fetch();
            $requete2 = $db->prepare("UPDATE employeur SET NomEntreprise=:nom WHERE idEmployeur=:id");
            $requete2->bindParam(':id', $id[0], PDO::PARAM_INT);
            $requete2->bindParam(':nom', $nom, PDO::PARAM_STR);
            $requete2->execute();
            $_SESSION['nomEntreprise']=$nom;
            header('location: modifier_entreprise.php');

        }else{

            echo "Veuillez entrez un nom d'entreprise";
        }
    }

?>
</body>
</html>
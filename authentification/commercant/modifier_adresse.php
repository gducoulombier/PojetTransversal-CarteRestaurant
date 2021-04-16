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
        <h1 class="w3-xxxlarge w3-text-red"><b>Modifier votre adresse</b></h1>
        <hr style="width:50px;border:5px solid red" class="w3-round">
    </div>

  <!-- Menu modification -->

<p>Votre adresse actuelle : <?php echo $_SESSION['adresse'] ?></p><br />

<form method="post" class="w3-container w3-card-4 w3-light-grey">
  <p>      
  <label>Veuillez saisir votre nouvelle adresse : </label>
  <input type="text" name="adresse" id="adresse" class="w3-input w3-border" required>
  </p>
  <p>
  <input class="w3-button w3-red w3-padding-large w3-hover-black" type="submit" name="formsend" id="formsend">
  </p>
</form>

  <!-- Traitement -->
<?php
    if(isset($_POST['formsend'])){
        
        extract($_POST); 
        if(!empty($adresse)){
            include '../../database.php';
			global $db;

            $requete1 = $db->prepare('SELECT idCommercant FROM compte c , commercant com  WHERE c.Email = :email AND c.Email=com.Email');
            $requete1->bindParam(':email', $_SESSION['email'], PDO::PARAM_STR );
            $requete1->execute();
            $id=$requete1->fetch();
            $requete2 = $db->prepare("UPDATE commercant SET Adresse=:adresse WHERE idCommercant=:id");
            $requete2->bindParam(':id', $id[0], PDO::PARAM_INT);
            $requete2->bindParam(':adresse', $adresse, PDO::PARAM_STR);
            $requete2->execute();

            $_SESSION['adresse']=$adresse;
            header('location: informations.php');

        }else{

            echo 'Veuillez entrez une adresse';
        }
    }

?>
</body>
</html>
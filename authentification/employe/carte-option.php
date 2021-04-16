<?php session_start(); ?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
   
    <?php include 'menu-employe.php'; ?>
    <link rel="stylesheet" href="../../css/slider.css">
    <meta http-quiv="Content-Type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:40px;margin-right:40px">

  <!-- Header / Solde -->
    <div class="w3-container" style="margin-top:20px" id="showcase">
        <h1 class="w3-xxxlarge w3-text-red"><b>Votre carte</b></h1>
        <hr style="width:50px;border:5px solid red" class="w3-round">
    </div>

  <!-- Initialisation variables -->
  <?php
    include '../../database.php';
		global $db;

    $requete = $db->prepare('SELECT e.idEmploye FROM compte c, employe e WHERE :email = c.Email AND c.Email=e.Email');
    $requete->bindParam(':email', $_SESSION['email'], PDO::PARAM_STR);
    $requete->execute();
    $id=$requete->fetch();
    $requete2=$db->prepare("SELECT Cartebloquee FROM cartes c, employe e WHERE c.idEmploye=:id AND c.idEmploye=e.idEmploye");
    $requete2->bindParam(':id', $id[0], PDO::PARAM_INT);
    $requete2->execute();
    $CarteBloquee=$requete2->fetch();
    $requete3=$db->prepare("SELECT ValeurSansContact FROM cartes c, employe e WHERE c.idEmploye=:id AND c.idEmploye=e.idEmploye");
    $requete3->bindParam(':id', $id[0], PDO::PARAM_INT);
    $requete3->execute();
    $ValeurSansContact=$requete3->fetch();

    if($CarteBloquee[0]==TRUE){
      $bloquer='bloquée';
      $texte="w3-text-red";
      $classe = "w3-btn w3-border w3-border-red w3-round-small"; 

    }else{
      $bloquer='débloquée';
      $texte="w3-text-green";
      $classe="w3-btn w3-border w3-border-green w3-round-small"; 
    }

    if($ValeurSansContact[0] == 0){
      $desactiver='désactivée';
      $texte2="w3-text-red";
      $classe2 = "w3-btn w3-border w3-border-red w3-round-large"; 

    }else{
      $desactiver='activé';
      $texte2="w3-text-green";
      $classe2="w3-btn w3-border w3-border-green w3-round-large"; 
    }

  ?>

  <!-- Bloquer carte / désactiver sans contact -->


  <form method="post">


    
    <h1 class="w3-xlarge w3-text-red"><b>Bloquer ma Carte</b></h1>
    <div> Votre carte est actuellement : <button class=<?php echo $classe ?> name="bloquer" id="bloquer"> <div class=<?php echo $texte ?>> <?php echo $bloquer ?> </div></button></div>
  
    <h1 class="w3-xlarge w3-text-red"><b>Desactiver le paiement sans contact</b></h1>
    <div> Le paiement sans contact est actuellement : <button class=<?php echo $classe2 ?> name="desactiver" id="desactiver"> <div class=<?php echo $texte2 ?>> <?php echo $desactiver ?> </div></button></div>
    
    <?php 
      if(isset($_POST['bloquer'])){

        if($CarteBloquee[0]==FALSE){
          $requete4 = $db->prepare("UPDATE cartes SET Cartebloquee=TRUE WHERE idEmploye=:id");
          $requete4->bindParam(':id', $id[0], PDO::PARAM_INT);
          $requete4->execute();
        
          
        }else{
          $requete4 = $db->prepare("UPDATE cartes SET Cartebloquee=FALSE WHERE idEmploye=:id");
          $requete4->bindParam(':id', $id[0], PDO::PARAM_INT);
          $requete4->execute();

        }
        header('location: carte-option.php');
      }


      if(isset($_POST['desactiver'])){

        if($ValeurSansContact[0]==0){
          $requete5 = $db->prepare("UPDATE cartes SET ValeurSansContact=30 WHERE idEmploye=:id");
          $requete5->bindParam(':id', $id[0], PDO::PARAM_INT);
          $requete5->execute();
        
          
        }else{
          $requete5 = $db->prepare("UPDATE cartes SET ValeurSansContact=0 WHERE idEmploye=:id");
          $requete5->bindParam(':id', $id[0], PDO::PARAM_INT);
          $requete5->execute();

        }
        header('location: carte-option.php');
      }
    
    ?>
  </form>


  <!-- Slider sans contact -->


<div class="slidecontainer">

<form method="post">
  <p>Montant maximum autorisé : <span id="demo"></span> €</p>
  <input type="range" min="0" max="50" value=<?php echo $ValeurSansContact[0]; ?> class="slider" name="var" id="myRange">
  <p>0€ - - - - - - - - - -10€ - - - - - - - - -20€ - - - - - - - - -30€ - - - - - - - - - 40€ - - - - - - - - -50€</p><br />
  <input class="w3-button w3-red w3-padding-large w3-hover-black" type="submit" name="formsend" id="formsend">
</form>

</div>

<script>
var slider = document.getElementById("myRange");
var output = document.getElementById("demo");
output.innerHTML = slider.value;

slider.oninput = function() {
  output.innerHTML = this.value;
}
</script>


<?php if(isset($_POST['formsend']))
	{

		$valeurSansContact=$_POST["var"];

		
		$requete6 = $db->prepare("UPDATE cartes SET ValeurSansContact=:valeurSansContact WHERE idEmploye=:id");
		$requete6->bindParam(':id', $id[0], PDO::PARAM_INT);
		$requete6->bindParam(':valeurSansContact',$valeurSansContact, PDO::PARAM_INT);
		$requete6->execute();
		

	    header('location: carte-option.php');
		
		
    }

?>



</body>
</html>
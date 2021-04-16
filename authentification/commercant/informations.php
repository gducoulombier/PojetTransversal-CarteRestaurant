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
        <h1 class="w3-xxxlarge w3-text-red"><b>Vos informations</b></h1>
        <hr style="width:50px;border:5px solid red" class="w3-round">
    </div>

  <!-- Informations -->

<TABLE> 
  <TR> 
    <TD> <p>Nom du restaurant : </p></TD>
    <TD> <p><?php echo $_SESSION['nomEntreprise']?></p> </TD>
    <TD></TD> 
  </TR>
  <TR> 
    <TD> <p>Adresse : </p></TD>
    <TD> <p><?php echo $_SESSION['adresse']?></p> </TD>
    <TD> <a class="w3-button w3-tiny w3-white w3-border w3-border-red w3-round-large" style="margin-left:50px" href ="modifier_adresse.php "> 
            Modifier </a></TD> 
  </TR> 
  <TR> 
    <TD> <p>RIB : </p></TD>
    <TD> <p><?php  echo $_SESSION['RIB'] ?></p> </TD>
    <TD> <a class="w3-button w3-tiny w3-white w3-border w3-border-red w3-round-large" style="margin-left:50px" href ="modifier_RIB.php "> 
            Modifier </a></TD> 
  </TR>
</TABLE> 


</main>
</body>
</html>
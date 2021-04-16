<?php session_start(); ?>

<!DOCTYPE html>
<html>

<head>
   
    <?php include 'menu-commercant.php'; ?>
    <meta http-quiv="Content-Type" content="text/html;charset=utf-8"/>
    
</head>

<body>
<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:40px;margin-right:40px">

  <!-- Header / Solde -->
    <div class="w3-container" style="margin-top:20px" id="showcase">
        <h1 class="w3-xxxlarge w3-text-red"><b>Installation du TPE</b></h1>
        <hr style="width:50px;border:5px solid red" class="w3-round">
    </div>

<!-- chargement du PDF -->

  <p>Afin de vous aider dans l'installation de votre terminal de paiement, vous trouverez une notice ci-dessous.</p>
  <iframe src="media/tpe-installation.pdf" width="100%" height="500px">
    </iframe>



</body>
</html>


</html>
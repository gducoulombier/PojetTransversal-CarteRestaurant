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
        <h1 class="w3-xxxlarge w3-text-red"><b>Commande de cartes</b></h1>
        <hr style="width:50px;border:5px solid red" class="w3-round">
    </div>


  <!-- Commande -->
  	<br />
	
	<h1 class="w3-xlarge w3-text-red"><b>Commande validée !</b></h1>

	<?php

		header('refresh:3; URL=commande-suivi.php');
		exit();
		
	?>
		
</body>
</html>
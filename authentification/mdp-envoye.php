<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../css/w3.css">
	<link rel="stylesheet" href="../css/poppins.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

	<div class="w3-bar w3-red">
		<a class="w3-bar-item w3-button fa fa-home" href="../index.php"> Home</a>
	</div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:40px;margin-right:40px">

  <!-- Header / Solde -->
  <div class="w3-container" style="margin-top:20px" id="showcase">
    <h1 class="w3-xxxlarge"><b>Mot de passe oublié</b></h1>
    <hr style="width:50px;border:5px solid red" class="w3-round">
  </div>

  	<br />
	
<!-- redirection -->

	<h1 class="w3-xlarge w3-text-red"><b>Mot de passe envoyé !</b></h1>

	<?php

		header('refresh:3; URL=connexion.php');
		exit();
		
	?>
		
</body>
</html>
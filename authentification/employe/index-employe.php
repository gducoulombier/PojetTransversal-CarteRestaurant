<?php session_start(); ?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
   
	<?php include 'menu-employe.php'; ?>
    <meta http-quiv="Content-Type" content="text/html;charset=utf-8"/>
    <link rel='stylesheet' type='text/css' href='../../css/jauge-circulaire.css' />
    
</head>

<body>
<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:40px;margin-right:40px">

  <!-- Header / Solde -->
  <div class="w3-container" style="margin-top:20px" id="showcase">
    <h1 class="w3-jumbo"><b>Bonjour <?php echo $_SESSION['nom']; ?></b></h1>
    <h1 class="w3-xxxlarge w3-text-red"><b>Votre solde</b></h1>
    <hr style="width:50px;border:5px solid red" class="w3-round">
  </div>

  <!-- Jauge circulaire -->
    <input type='text' name='compteur' value=<?php echo $_SESSION['soldeCompte']; ?> class='compteur' data-min='0' data-max='100' /> 

    <script language='Javascript' type='text/javascript'
    src='http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js'></script>
    <script language='Javascript' type='text/javascript'
    src='../../js/jauge-circulaire-fonction-dessin-jauge.js'></script>
    <script language='Javascript' type='text/javascript'
    src='../../js/jauge-circulaire.js'></script>


</body>

    
</html>

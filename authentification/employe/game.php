<?php session_start(); ?>

<!DOCTYPE html>
<html>

<head>
   
    <?php include 'menu-employe.php'; ?>
    <meta http-quiv="Content-Type" content="text/html;charset=utf-8"/>
    
</head>

<body>
<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:40px;margin-right:40px">

  <!-- Header / Solde -->
    <div class="w3-container" style="margin-top:20px" id="showcase">
        <h1 class="w3-xxxlarge w3-text-red"><b>Mini-jeux</b></h1>
        <hr style="width:50px;border:5px solid red" class="w3-round">
    </div>

  <!-- Carte -->


</body>


    <?php include '../../game/index-game.php'; ?>

    <?php echo $_SESSION['soldeCompte']; ?>

</html>
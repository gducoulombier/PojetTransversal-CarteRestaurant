<?php session_start(); ?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<!-- Style -->
<style>
/* The container */
.container {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 22px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default radio button */
.container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
}

/* Create a custom radio button */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
  border-radius: 50%;
}

/* On mouse-over, add a grey background color */
.container:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the radio button is checked, add a blue background */
.container input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the indicator (the dot/circle - hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the indicator (dot/circle) when checked */
.container input:checked ~ .checkmark:after {
  display: block;
}

/* Style the indicator (dot/circle) */
.container .checkmark:after {
 	top: 9px;
	left: 9px;
	width: 8px;
	height: 8px;
	border-radius: 50%;
	background: white;
}
</style>

<!-- Fin Style / Début page -->

<head>
   
    <?php include 'menu-employe.php'; ?>
    <meta http-quiv="Content-Type" content="text/html;charset=utf-8"/>
    
</head>

<body>
<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:40px;margin-right:40px">

  <!-- Header / Solde -->
    <div class="w3-container" style="margin-top:20px" id="showcase">
        <h1 class="w3-xxxlarge w3-text-red"><b>Votre carte</b></h1>
        <hr style="width:50px;border:5px solid red" class="w3-round">
    </div>



  <!-- Présentation des cartes -->

<p>Votre carte expirera le : 2022-02-01 <br />
Vous pouvez dès à présent selectionner le prochain modèle qui vous sera envoyé !</p>


<table class="w3-table">
    <tr>
        <td><img src="../../img/carte.png" style="width:400px"></td>
        <td><img src="../../img/carte2.png" style="width:400px"></td>
    </tr>
    <tr>
    	<td>
    		<label class="container">Modèle bleu
  			<input type="radio" checked="checked" name="radio">
  			<span class="checkmark"></span>
			</label>
		</td>
    	<td>
    		<label class="container">Modèle gris
			<input type="radio" name="radio">
			<span class="checkmark"></span>
			</label>
    	</td>
    </tr>
</table>

<a href="index-employe.php">
<button class="w3-button w3-red">Valider</button>
</a>
<br />




</div>



</body>
</html>
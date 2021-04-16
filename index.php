<!DOCTYPE html>
<html lang="en">

<title>WineMoreTime</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/w3.css">
<link rel="stylesheet" href="css/poppins.css">

<style>
  body,h1,h2,h3,h4,h5 {font-family: "Poppins", sans-serif}
  body {font-size:16px;}
  .w3-half img{margin-bottom:-6px;margin-top:16px;opacity:0.8;cursor:pointer}
  .w3-half img:hover{opacity:1}
</style>

<body>


<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-red w3-collapse w3-top w3-large w3-padding" style="z-index:3;width:300px;font-weight:bold;" id="mySidebar"><br>
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-hide-large w3-display-topleft" style="width:100%;font-size:22px">Close Menu</a>
  <div class="w3-container">
    <h3 class="w3-padding-64"><b>WineMoreTime</b></h3>
  </div>
  <div class="w3-bar-block">
    <a href="#" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Accueil</a> 
    <a href="#services" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Services</a>
    <a href="#packages" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Offres</a> 
    <a href="#restaurants" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Restaurants</a>  
    <a href="#contact" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Contact</a>
  </div>
  <div class="w3-bar w3-bottom">
    <a href="authentification/employe/inscription.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">S'inscrire</a> 
    <a href="authentification/connexion.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Se connecter</a> 
  </div>
</nav>

<!-- Top menu on small screens -->
<header class="w3-container w3-top w3-hide-large w3-red w3-xlarge w3-padding">
  <a href="javascript:void(0)" class="w3-button w3-red w3-margin-right" onclick="w3_open()">☰</a>
  <span>WineMoreTime</span>
</header>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>



<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:340px;margin-right:40px">

  <!-- Header -->
  <div class="w3-container" style="margin-top:80px" id="showcase">
    <h1 class="w3-jumbo"><b>La carte restaurant</b></h1>
    <h1 class="w3-xxxlarge w3-text-red"><b>Accueil.</b></h1>
    <hr style="width:50px;border:5px solid red" class="w3-round">
  </div>
  
  <!-- Photo grid (modal) -->
  <div class="w3-row-padding">
    <div class="w3-half">
      <img src="img/restaurant.jpg" style="width:100%" onclick="onClick(this)">
    </div>
    <div class="w3-half">
      <img src="img/carte.png" style="width:100%" onclick="onClick(this)">
    </div>
  </div>

  <!-- Modal for full size images on click-->
  <div id="modal01" class="w3-modal w3-black" style="padding-top:0" onclick="this.style.display='none'">
    <span class="w3-button w3-black w3-xxlarge w3-display-topright">×</span>
    <div class="w3-modal-content w3-animate-zoom w3-center w3-transparent w3-padding-64">
      <img id="img01" class="w3-image">
      <p id="caption"></p>
    </div>
  </div>

  <!-- Services -->
  <div class="w3-container" id="services" style="margin-top:75px">
    <h1 class="w3-xxxlarge w3-text-red"><b>Services.</b></h1>
    <hr style="width:50px;border:5px solid red" class="w3-round">
    <p>L’entreprise AVENTIX vous propose un projet qui vise à remplacer les chèques restaurants par une carte à puce qui vous permettra le paiement de vos repas.</p>
    <p>Une fois la carte en votre possession, vous pourrez payer vos repas avec celle-ci comme si c'était votre carte bancaire. Sauf qu'avec notre carte, votre employeur vous paie une partie du repas !</p>
    <p>Parlez-en à votre employeur pour que celui-ci adhère à notre service :)</p>
  </div>


  <!-- Packages / Pricing Tables -->
  <div class="w3-container" id="packages" style="margin-top:75px">
    <h1 class="w3-xxxlarge w3-text-red"><b>Offres.</b></h1>
    <hr style="width:50px;border:5px solid red" class="w3-round">
    <p>Vous avez une entreprise et souhaitez offrir un service de cartes restaurants pour vos employés, nos offres sont faites pour vous. Vous pourrez souscrire à un abonnement afin d'offrir cet avantage à vos employés.</p>
  </div>

  <div class="w3-row-padding">
    <div class="w3-half w3-margin-bottom">
      <ul class="w3-ul w3-light-grey w3-center">
        <li class="w3-dark-grey w3-xlarge w3-padding-32">Basic</li>
        <li class="w3-padding-16">Envoi des cartes</li>
        <li class="w3-padding-16">100 cartes maximum</li>
        <li class="w3-padding-16">Prix d'une carte : 7€</li>
        <li class="w3-padding-16">Modification de la prise en charge générale</li>
        <li class="w3-padding-16">Support disponible par mail</li>
        <li class="w3-padding-16">
          <h2>249 €</h2>
          <span class="w3-opacity">par mois</span>
        </li>
        <li class="w3-light-grey w3-padding-24">
          <button class="w3-button w3-white w3-padding-large w3-hover-black">Sign Up</button>
        </li>
      </ul>
    </div>
        
    <div class="w3-half">
      <ul class="w3-ul w3-light-grey w3-center">
        <li class="w3-red w3-xlarge w3-padding-32">Premium</li>
        <li class="w3-padding-16">Envoi des cartes prioritaire</li>
        <li class="w3-padding-16">Nombre illimité de cartes</li>
        <li class="w3-padding-16">Prix d'une carte : 5€</li>
        <li class="w3-padding-16">Prise en charge ajustable pour chaque compte</li>
        <li class="w3-padding-16">Support disponible par mail et par téléphone</li>
        <li class="w3-padding-16">
          <h2>999 €</h2>
          <span class="w3-opacity">par mois</span>
        </li>
        <li class="w3-light-grey w3-padding-24">
          <a href="authentification/employeur/inscription.php" class="w3-button w3-red w3-padding-large w3-hover-black">Sign Up</a>
        </li>
      </ul>
    </div>
  </div>
  

  <!-- Restaurateurs -->
  <div class="w3-container" id="restaurants" style="margin-top:75px">
    <h1 class="w3-xxxlarge w3-text-red"><b>Restaurants.</b></h1>
    <hr style="width:50px;border:5px solid red" class="w3-round">
    <p>Vous êtes restaurateur et désirez proposer ce moyen de paiement à vos clients ?</p>
    <p>Pas besoin de nouveau matériel, votre terminal de paiement (TPE) actuel est tout à fait capable de vous permettre d'accepter ce type de paiement. Il vous suffit de créer un compte Aventix et d'enregistrer votre TPE chez nous afin de pouvoir proposer ce service.</p>
    <p>Inscrivez vous maintenant pour commencer l'aventure Aventix !</p>
    <a href="authentification/commercant/inscription.php" class="w3-button w3-red w3-padding-large w3-hover-black">Sign Up</a>
  </div>


  <!-- Contact -->
  <div class="w3-container" id="contact" style="margin-top:75px">
    <h1 class="w3-xxxlarge w3-text-red"><b>Contact.</b></h1>
    <hr style="width:50px;border:5px solid red" class="w3-round">
    <p>Vous avez des questions ? N'hésitez pas à nous contacter afin que nous y répondons dans les plus brefs délais.</p>
    <form action="/action_page.php" target="_blank">
      <div class="w3-section">
        <label>Nom</label><br/>
        <input class="w3-input-big w3-border" type="text" name="Name" required>
      </div>
      <div class="w3-section">
        <label>Entreprise</label><br/>
        <input class="w3-input-big w3-border" type="text" name="Entreprise" required>
      </div>
      <div class="w3-section">
        <label>Email</label><br/>
        <input class="w3-input-big w3-border" type="text" name="Email" required>
      </div>
      <div class="w3-section">
        <label>Message</label>
        <input class="w3-input w3-border" type="text" name="Message" required>
      </div>
      <button type="submit" class="w3-button w3-block w3-padding-large w3-red w3-margin-bottom">Envoyer</button>
    </form>  
  </div>

<!-- End page content -->
</div>

<!-- W3.CSS Container -->
<div class="w3-light-grey w3-container w3-padding-32" style="margin-top:75px;padding-right:58px"><p class="w3-right">Groupe AVENTIX</p></div>

<script>
// Script to open and close sidebar
function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("myOverlay").style.display = "block";
}
 
function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("myOverlay").style.display = "none";
}

// Modal Image Gallery
function onClick(element) {
  document.getElementById("img01").src = element.src;
  document.getElementById("modal01").style.display = "block";
  var captionText = document.getElementById("caption");
  captionText.innerHTML = element.alt;
}
</script>

</body>
</html>

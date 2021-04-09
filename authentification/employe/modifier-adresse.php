<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<titre>Modifier votre Adresse</titre>
</head>

<body>

<form method="post">
		<div> Votre adresse actuelle <?php echo $_SESSION['Adresse'] ?></div>
		<input type="text" name="adresse" id="adresse" placeholder="adresse" required>
        <br>
        <input type="reset" name="reset" id="reset">
        <br>
        <input type="submit" name="formsend" id="formsend">
        <br>
	</form>

<?php
    if(isset($_POST['formsend'])){
        if(!empty($Adresse)){

        
            extract($_POST);    
            $requete3 = $db->query('SELECT idEmploye FROM compte c, employe e WHERE email = e.email ');
            $id=$requete1->execute('email' => $_SESSION['email']);
            $requete4=$db->query('UPDATE Adresse FROM  employe WHERE idEmploye = id');
            $requete4->execute(
                'id' => $id
                'Adresse'=$Adresse
            );

        }else{

            echo 'Veuillez entrez une Adresse'
        }
    }

?>
</body>
</html>
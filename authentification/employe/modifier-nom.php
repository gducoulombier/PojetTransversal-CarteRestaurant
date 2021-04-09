<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<titre>Modifier votre Nom</titre>
</head>

<body>

<form method="post">
		<div> Votre nom actuel <?php echo $_SESSION['Nom'] ?></div>
		<input type="text" name="nom" id="nom" placeholder="nom" required>
        <input type="reset" name="reset" id="reset">
        <input type="submit" name="formsend" id="formsend">
	</form>

<?php
    if(isset($_POST['formsend'])){
        if(!empty($nom)){

            extract($_POST);    
            $requete1 = $db->query('SELECT idEmploye FROM compte , employe  WHERE (email = :email)');
            $id=$requete1->execute('email' => $_SESSION['email']);
            $requete2=$db->query('UPDATE Nom FROM  employe WHERE idEmploye = id');
            $requete2->execute(
                'id' => $id
                'Nom'=>$nom
            );

        }else{

            echo 'Veuillez entrez un nom'
        }
    }

?>
</body>
</html>
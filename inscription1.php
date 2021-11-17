<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <form action="#" method="post" >
        <label>Nom</label>      
        <input type="text" name='nom' autocomplete='off' required>

        <label>Prenom</label>
        <input type="text" name='prenom' autocomplete='off' required>
        

        <label>Nom d'utilisateur</label>
        <input type="text" name="user" autocomplete='off' required>
        

        <label>Mot de passe</label> 
        <input type="password" name="mdp" autocomplete='off' required>
        


        <label>Confirmer le mot de passe</label>
        <input type="password" name="confirmer" autocomplete='off' required>
        

        <input type="submit" name="valider" >
        
    </form>
</body>
</html>

<?php

$servname = 'localhost';
$dbname = 'moduleconnexion'; 
$user = 'root';
$mdp ='';



try{
$bdd = new PDO("mysql:host=$servname;dbname=$dbname","$user","$mdp");
$bdd-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = $bdd->prepare(

        "INSERT INTO utilisateurs(nom,prenom,login,password)
        VALUES (:nom,:prenom,:login,:password)"
        
    );
        

$sql->bindParam(':nom', $nom);
$sql->bindParam(':prenom', $prenom);
$sql->bindParam(':login', $login);
$sql->bindParam(':password', $password);



$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$login = $_POST['user'];
$password = $_POST['mdp'];
$sql->execute();

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

}

catch(PDOException $e){

    echo 'echec : ' .$e->getMessage();
}

if (password_verify($password, $hashed_password)){
    
    echo 'Password Matches';
}else {
    
    echo 'Password Mismatch';
}

var_dump($hashed_password);


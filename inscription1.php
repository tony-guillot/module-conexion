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
$dbname = 'moduleconnexion';  // log de connexion à la bdd 
$user = 'root';
$mdp ='';



try{
$bdd = new PDO("mysql:host=$servname;dbname=$dbname","$user","$mdp");//connexion à la bdd
$bdd-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
catch(PDOException $e){

    echo 'echec : ' .$e->getMessage();
}


$sql = $bdd->prepare(

        "INSERT INTO utilisateurs(nom,prenom,login,password) 
        VALUES (:nom,:prenom,:login,:password)"
        
    );
        // prépare l'insertion des valeurs dans la bdd

$sql->bindParam(':nom', $nom);
$sql->bindParam(':prenom', $prenom); // 
$sql->bindParam(':login', $login);
$sql->bindParam(':password', $hashed_password);
// on définit les valeurs des differentes entrées dans VALUES 


$nom = $_POST['nom'];
$prenom = $_POST['prenom']; // assosiation des valeur du formulaire POST aux variables
$login = $_POST['user'];
$password = $_POST['mdp'];
$hashed_password = password_hash($password, PASSWORD_DEFAULT); 
$passwordCorrect = password_verify($password, $hashed_password);
//password_hash pour crypter le mdp, a mettre avant  execute()


$usercheck = $pdo->prepare






if($password != $_POST['confirmer']){

        die('les mots de passe ne sont pas identique ');
}
    else{

    $sql->execute();
}





















var_dump($hashed_password);


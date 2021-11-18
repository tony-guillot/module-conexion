<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<form action="#" method="post">
    <label>Login</label>
    <input type="text" name="login" require>

    <label>password</label>
    <input type="password" name='mot de passe'require>

    <input type="submit"  name ='valider'value="se connecter">
</form>
</body>
</html>

<?php
session_start();

$servname = 'localhost';
$dbname = 'moduleconnexion';  // log de connexion à la bdd 
$user = 'root';
$mdp ='';


// try{
//     $bdd = new PDO("mysql:host=$servname;dbname=$dbname","$user","$mdp");//connexion à la bdd
//     $bdd-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
//     }
    
//     catch(PDOException $e){
    
//         echo 'echec : ' .$e->getMessage();
//     }



if(isset($_POST['valider'])){


    @$login = $_POST['login'];
    @$password = $_POST['password'];
    $erreur ="";

    $bdd = new PDO("mysql:host=$servname;dbname=$dbname","$user","$mdp");//connexion à la bdd
    
    $sql= "SELECT * FROM utilisateur  WHERE login = $login ";
    $result = $bdd->prepare($sql);
    $result->execute();

    if($result->rowCount() > 0){
       
        $data = $result->fetch(PDO::FETCH_ASSOC);
         
        if(password_verify($password, $data[0]['password'])){

            echo 'connexion reussi';
            $_SESSION['login'] = $login;
        }   
        
    if(isset($_SESSION['login']))
    {
        echo "Vous êtes connecté";
    }
    


    }else{

            echo ' la connexion a echouée';
    }
}
        var_dump($_SESSION);

var_dump($sql);

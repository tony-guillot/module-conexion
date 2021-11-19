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
    <input type="password" name='password' require>

    <input type="submit"  name ='valider'value="valider">
</form>
</body>
</html>

<?php
session_start();



$servname = 'localhost';
$dbname = 'moduleconnexion';  // log de connexion à la bdd 
$user = 'root';
$mdp ='';



 try{
    $bdd = new PDO("mysql:host=$servname;dbname=$dbname","$user","$mdp");//connexion à la bdd
     $bdd-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }
    
    // message en cas d'erreur 
    catch(PDOException $e){
    
         echo 'echec : ' .$e->getMessage();
     }
        
        // Si l'entrée de login et le mot de passe ont une valeur 
        if(isset($_POST['login']) && isset($_POST['password'])){

            //si login n'est pas vide et que password a une valeur
            if(!empty($_POST['login']) && isset($_POST['password'])){

                // alors la variable login = l'entrée de login 
                $login = $_POST['login'];

                // requete SQL 
                $req = $bdd->prepare('SELECT login,password FROM utilisateurs WHERE login=:login');
                $req->bindValue(':login', $login); // association des valeurs de :login
                $req->execute(); // execute la requete SQL
                
               
                
                
            $resultat = $req->fetch(); // récupère les valeurs de la requete SQL stocké sur la BDD 

            //on verify si le mot de pass correspont au mot de pass hash de la basse de donné 
            if (!$resultat OR !password_verify($_POST['password'], $resultat['password'])){


                echo 'Identifiant ou mot de passe incorrect';
                
            
              }
            
              
              else{

                echo 'Vous êtes connecté';
              }
            
              
        }else{

            echo 'Renseigner un Nom d\'utilisateur et un mot de passe';
        }
       
    }
     
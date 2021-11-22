<?php
session_start();



?>
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

    <header>
        <nav>
            <ul>
                <li>
                    <a href="index.php">Accueil</a>
                    <a href="connexion.php">Connexion</a>
                    <a href="inscription.php">Inscription</a>
                </li>
            </ul> 
        </nav>
    </header>

    <main class="container1">
        
        <form class="formulaire" action="#" method="post" >
        
        <h1>Inscription</h1>

        <label>Nom</label>   
        <br>   
        <input type="text" name='nom' autocomplete='off' required>

        <label>Prenom</label>
        <br>
        <input type="text" name='prenom' autocomplete='off' required>
        

        <label>Nom d'utilisateur</label>
        <br>
        <input type="text" name="user" autocomplete='off' required>
        

        <label>Mot de passe</label> 
        <br>
        <input type="password" name="mdp" autocomplete='off' required>
        


        <label>Confirmer le mot de passe</label>
        <br>
        <input type="password" name="confirmer" autocomplete='off' required>

        

        <input type="submit" name="valider" >
        
    </form>
</main>
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

@$login = $_POST['user'];
@$nom =$_POST['nom'];
@$prenom = $_POST['prenom'];
@$password = sha1($_POST['mdp']);
@$confir = sha1($_POST['confirmer']);


@$login = htmlspecialchars(trim($login));
@$nom = htmlspecialchars(trim($nom));
@$prenom = htmlspecialchars(trim($prenom));
@$password = htmlspecialchars(trim($password));

$sql = "SELECT COUNT(login) AS num FROM utilisateurs WHERE login=:login";
$stmt =$bdd->prepare($sql);
$stmt->bindValue(':login', $login);
$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row['num'] > 0 ){

            echo '<p class="erreur"> ' .'le nom d\'utilisateur est dejà pris'. '</p>';

        }elseif($_POST['mdp'] != $_POST['confirmer']){

            die('les mots de passe se sont pas identique');
        }
            
    else{


$sql2 = "INSERT INTO utilisateurs (login,nom,prenom,password)VALUES(:login, :nom, :prenom, :password)"; 
$stmt = $bdd->prepare($sql2);
$stmt ->bindValue(':login', $login, PDO::PARAM_STR);
$stmt ->bindValue(':nom', $nom, PDO::PARAM_STR);
$stmt ->bindValue(':prenom', $prenom, PDO::PARAM_STR);
$stmt ->bindValue(':password', $password, PDO::PARAM_STR);
    

        if($stmt->execute()){

            
            echo 'inscription reussi';

           }else{

            echo 'echec de l\'inscritpion';
        }

    
    }



    









































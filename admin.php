<?php
session_start();

$servname = 'localhost';
$dbname = 'moduleconnexion';  // log de connexion à la bdd 
$user = 'root';
$mdp ='';

$bdd = new PDO("mysql:host=$servname;dbname=$dbname;charset=utf8","$user","$mdp");//connexion à la bdd
$bdd-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$utilisateurs = $bdd->query("SELECT * FROM utilisateurs ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration</title>
</head>
<body>
    <ul>
        
            <?php while($u = $utilisateurs->fetch()) {?>

                    <li> <?= $u['id'] ?> : <?= $u['login']?> : <?= $u['nom']?> : <?= $u['prenom']?> </li>
                    
                    <?php } ?>
                
        
    </ul>
</body>
</html>









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

    
            $sql = $bdd->prepare("SELECT * FROM utilisateurs WHERE if = :num");

            $sql->bindValue(':num', $_POST['']);

            $result = $sql->fetch();

            $sql->execute();
            
            

            var_dump($result);


?>

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

            <label > Modifier vote nom </label>
            <input type="text" name="nom" placeholder="votre nom" require
            value="<?php $result['nom']?>">

            <label > Modifier vote prenom </label>
            <input type="text" name="prenom" placeholder="votre prenom" require value="<?php echo $result['prenom']?>">

            
            <label > Modifier vote nom d'utilisateur </label>
            <input type="text" name="login" placeholder="votre nom d\'utilisateur" require>

            <input type="submit" name="modif" placeholder="Mpdifier votre profil" require>

            </form>
</body>
</html>

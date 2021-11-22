<?php
session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Module de conexion</title>
</head>
<body>
    <main>

    <h1>Module de conexion</h1>
    <button><a href="inscription1.php">Inscription</a></button>
    <button><a href="connexion.php">Connexion</a></button>
    <button><a href="profil1.php">Modifier votre profil </a></button>
    <?php
    

        

//     if(isset($_SESSION['login']))
// {
//     echo "Vous êtes connecté"   .$_SESSION['login'];
// }else{
     
//     echo 'vous êtes deconnecté';
// }

?>

    </main>
</body>
</html>


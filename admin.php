<?php
session_start();

$servname = 'localhost';
$dbname = 'tony-guillot_moduleconnexion';     // log de connexion à la bdd 
$user = 'tonyguillot';
$mdp ='toto199800912';


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
    <link rel="stylesheet" href="style.css">
    <title>Administration</title>
</head>
<body>
<header>
            <nav>
                <ul>
                     <li>
                        <a href="index.php">Accueil</a>
                        <a href="connexion.php">Connexion</a>
                        <a href="inscription1.php">Inscription</a>
                        <a href="profil1.php">Modifier le profil</a>
                    </li>
                </ul> 
            </nav>
            <ul>
    </header>

            <h1 id="admin">Page Administrateur</h1>
    
        
            <?php while($u = $utilisateurs->fetch()) {?>

                    <li id="admin2"> <?php echo $u['id'] ?> : <?php echo $u['login']?> : <?php echo$u['nom']?> : <?php echo $u['prenom']?> </li>
                    
                    <?php } ?> 
                
                    
        
    
<footer class="footer">

<ul class="navigation">
    <h3 class="navi">Navigation</h3>
    <li><a href="index.php">Connexion</a></li>
    <li><a href="conneion.php">connexion</a></li>
    <li><a href="inscription.php">inscription</a></li>
</ul>

<ul class="contact">
    <h3 class="info">Mes informations</h3>
    <li>Tony Guillot</li>
    <li>Tony.guillot@laplateforme.io</li>
    <li><a href="https://github.com/tony-guillot/module-connexion.git">Repository Github</a></li>
</ul>
</body>
</html>


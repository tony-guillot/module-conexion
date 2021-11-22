<?php
session_start();

$servname = 'localhost';
$dbname = 'moduleconnexion';  // log de connexion à la bdd 
$user = 'root';
$mdp ='';


 try{
    $bdd = new PDO("mysql:host=$servname;dbname=$dbname","$user","$mdp");//connexion à la bdd
     $bdd-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
    
    // message en cas d'erreur 
 
        
        if(isset($_POST['valider'])){

            $login = htmlspecialchars($_POST['login']);
            $password = sha1($_POST['password']);
            
            
           
            if(!empty($login) && !empty($password)){

                $requser = $bdd->prepare("SELECT * FROM utilisateurs WHERE login=:login AND password=:password");
                $requser->bindValue(':login', $login);
                $requser->bindValue(':password', $password);
                $requser->execute(); 
                $userexist = $requser->rowCount();

                if($userexist == 1 ){
                    
                    $userinfo = $requser->fetch();
                    $_SESSION['id'] = $userinfo['id'];
                    $_SESSION['login'] = $userinfo['login'];
                    $_SESSION['nom'] = $userinfo['nom'];
                    $_SESSION['prenom'] = $userinfo['prenom'];
                    $_SESSION['password'] = $userinfo['password'];
                    
                
                if($userinfo['login'] == 'admin'){

                    header('location: admin.php');
                }

            }else{

                echo '<p class="erreur">'.'Mauvais identifiant ou mot de passe'. '</p>';
            }
            }
            
        }
     
}   catch(PDOException $e){
    
    echo 'echec : ' .$e->getMessage();
}
?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>connexion</title>
</head>
<body>
<header>
        <nav>
            <ul>
                <li>
                    <a href="index.php">Accueil</a>
                    <a href="connexion.php">Connexion</a>
                    <a href="insription1.php">Inscription</a>
                </li>
            </ul> 
        </nav>
    </header>

    
    <main class="main2 ">

        <div class="container2">
    <form class="formulaire2" action="#" method="post">

    <h1>Connexion</h1>
    <br>

         <label>Nom d'utilisateur</label>
         <br>
        <input type="text" name="login" require>

        <label>Mot de passe</label>
        <br>
        <input type="password" name='password' require>
   

        <input type="submit"   name ='valider'value="valider">

    </form>
            </div>

            <div class="profil">

             <h2 id="connexion">Profil de <?php echo @$userinfo['login'];?></h2>
 
            
            <h3>nom :  <?php echo @$userinfo['nom'];?></h3>
             

             <h3>Prenom : <?php echo @$userinfo['prenom'];?> </h3>

            
            
            <button ><a href="deconnexion">Se deconnecter</a></button>

            <a href="profil1.php">Modifier mon profil</a>
         </div>
</main>



</body>
</html>


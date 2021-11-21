
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
        
        if(isset($_POST['valider'])){

            $login = htmlspecialchars($_POST['login']);
            $password = htmlspecialchars($_POST['password']);

            if(!empty($login) && !empty($password)){

                $requser = $bdd->prepare("SELECT * FROM utilisateurs WHERE  login=?");
                $requser->execute(array($login));
                $userexist = $requser->rowCount();

                if($userexist == 1){
                    
                    $userinfo = $requser->fetch();
                    $_SESSION['id'] = $userinfo['id'];
                    $_SESSION['login'] = $userinfo['login'];
                    $_SESSION['nom'] = $userinfo['nom'];
                    $_SESSION['prenom'] = $userinfo['prenom'];
                
            }else{

                echo 'Mauvais nom d\utilisateur ou mot de passe';
            }
            }
            
        }
    
?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>connexion</title>
</head>
<body>


    
    
<form action="#" method="post">
    <label>Nom d'utilisateur</label>
    <input type="text" name="login" require>

    <label>Mot de passe</label>
    <input type="password" name='password' require>
   

    <input type="submit"  name ='valider'value="valider">


    <div class="profil">
             <h2>Profil de <?php echo $userinfo['login'];?>
             <br></br>
            
             nom :  <?php echo $userinfo['nom'];?>
             <br></br>

             Prenom : <?php echo $userinfo['prenom'];?>

            </h2>
            
            <button ><a href="deconnexion">Se deconnecter</a></button>

            <a href="profil1.php">Modifier mon profil</a>
         </div>

</form>


</body>
</html>

<?php

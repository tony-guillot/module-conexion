<?php
session_start();

$servname = 'localhost';
$dbname = 'moduleconnexion';  // log de connexion à la bdd 
$user = 'root';
$mdp ='';

$bdd = new PDO("mysql:host=$servname;dbname=$dbname","$user","$mdp");//connexion à la bdd
$bdd-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try{
if(isset($_SESSION['id'])){


    $requser = $bdd->prepare("SELECT * FROM utilisateurs WHERE id =? ");
    $requser->execute(array($_SESSION['id']));
    $user = $requser->fetch();

    if( isset($_POST['newlogin']) AND !empty($_POST['newlogin']) AND $_POST['newlogin'] != $user['login']){

        $newlogin = htmlspecialchars($_POST['newlogin']);
        $insertlogin = $bdd->prepare("UPDATE utilisateurs SET login=? WHERE id=?");
        $insertlogin->execute(array($newlogin, $_SESSION['id']));
        header('Location: connexion.php');
    }
    if( isset($_POST['newnom']) AND !empty($_POST['newnom']) AND $_POST['newnom'] != $user['nom']){

        $newnom = htmlspecialchars($_POST['newnom']);
        $insertnom = $bdd->prepare("UPDATE utilisateurs SET nom=? WHERE id=?");
        $insertnom->execute(array($newnom, $_SESSION['id']));
        header('Location: connexion.php');
    }
    if( isset($_POST['newprenom']) AND !empty($_POST['newprenom']) AND $_POST['newprenom'] != $user['prenom']){

        $newprenom = htmlspecialchars($_POST['newprenom']);
        $insertprenom = $bdd->prepare("UPDATE utilisateurs SET prenom=? WHERE id=?");
        $insertprenom->execute(array($newprenom, $_SESSION['id']));
        header('Location: connexion.php');
    }
    

    if(isset($_POST['newmdp']) AND !empty($_POST['newmdp']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2'])) {

       
        $mdp1 = sha1($_POST['newmdp']);
        $mdp2 = sha1($_POST['newmdp2']);
        
        if($mdp1 == $mdp2){

            $insertmdp = $bdd->prepare("UPDATE utilisateurs  SET  password=? WHERE id=?");
            $insertmdp->execute(array($mdp1, $_SESSION['id']));
            header('location: connexion.php');

        }else{
            echo 'Les mot de passe ne correspondent pas ';
        }
        
    }
}
} catch(PDOException $e){
    
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
    <title>modification du profil</title>
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
    </header>
            <main class="modif1">

                

                <form classe="modif" action="#" method="post">

                <h2>Modification de mon profil</h2>

                <label>Nom :</label>
                
                    <input classe ="input-profil" type="text" name="newnom" placeholder="nom" value="<?php echo @$user['nom']?>">
                    

                    <label>Prenom : </label>
                    
                    <input classe ="input-profil" type="text" name="newprenom" placeholder="prenom" value="<?php echo @$user['prenom']?>"><br>  

                    <label>Nom d'utilisateur</label>
                    <input type="text" name="newlogin" placeholder="nom d'utilisateur" value="<?php echo @$user['login']?>">

                    <label>Mot de passe</label> 
                    <input classe ="input-profil" type="password" name='newmdp' placeholder="mot de passe" >
                      

                    <label>Confirmer le mot de passe</label>
                    
                    <input classe ="input-profil" type="password" name='newmdp2' placeholder="Confirmer le   mot de passe">

                    <input  id='modifier' type="submit" value="Modifier">
                    
                </form>

</main>

<footer class="footer">

<ul class="navigation">
    <h3 class="navi">Navigation</h3>
    <li><a href="index.html">Accueil</a></li>
    <li><a href="voyage6.html">Contactez-nous</a></li>
</ul>

<ul class="contact">
    <h3 class="info">Mes informations</h3>
    <li>Tony Guillot</li>
    <li>Tony.guillot@laplateforme.io</li>
    <li><a href="https://github.com/tony-guillot/module-connexion.git">Repository Github</a></li>
</ul>

</footer>
</body>
</html>

















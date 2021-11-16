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
    <form action="inscription.php" method="post">
        <label>Nom</label>      
        <input type="text" name='nom' autocomplete='off'>

        <label>Prenom</label>
        <input type="text" name='prenom' autocomplete='off'>
        

        <label>Nom d'utilisateur</label>
        <input type="text" name="user" autocomplete='off'>
        

        <label>Mot de passe</label> 
        <input type="password" name="mdp" autocomplete='off'>
        


        <label>Confirmer le mot de passe</label>
        <input type="password" name="confirmer" autocomplete='off'>
        

        <input type="submit" name="valider" >
        
    </form>
</body>
</html>

<?php

//conexion base de donné

// $bdd = new PDO('mysql:host=localhost;dbname=moduleconnexion;charset=utf8',
// 'root','');

$bdd = mysqli_connect("localhost", "root", "", "moduleconnexion");

if($bdd === false){
    
    die("erreur, imposible de se connecter" .
    mysqli_connect_error());
}




if(isset($_POST['valider'])){


    if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['user']) && !empty($_POST['mdp']) && !empty($_POST['confirmer'])){

        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $login = htmlspecialchars($_POST['user']);
        $password = $_POST['mdp'];
        $confirmer = $_POST['confirmer'];
        $insert  = "INSERT INTO utilisateurs(login,nom,prenom,password) VALUES('$nom','$prenom','$login','$password')";
        
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        mysqli_query($bdd, $insert);
        }

    

}
?>
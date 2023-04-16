<?php

   // connexion avec la database
require_once 'database.php';



// update de l'user_name : on vérifie si il y a un user_name et un id
    if(isset($_GET["user_name"]) && isset($_GET["id"])){

        // on les passe en htmlspecialchars pour empecher les failles xss et on les place dans des variables qu'on à nommées
        $id = htmlspecialchars($_GET["id"]);
        $GETuser_name = htmlspecialchars($_GET["user_name"]);
    }
    

    // si un user_name à été posté et existe
    if(isset($_POST["user_name"])){

        // on le passe en htmlspecialchar
        $user_name = htmlspecialchars($_POST["user_name"]);

        // si le user_name n'est pas vide dans l'input
        if($user_name !== ''){

            // on prepare et execute dans la table users le nouveau user_name choisis et post
            $edit = $pdo->prepare("UPDATE users SET user_name = ? WHERE id = ?");
            $edit->execute([$user_name, $id]);

            // en réussite :
            header("Location: ../profil.php?success=modification réussi !");

        }
        else{
            // si erreur :
            $error = "veuillez remplir les champs";
        }
    }


    // update de l'email
    if(isset($_GET["email"]) && isset($_GET["id"])){

        // on les passe en htmlspecialchars pour empecher les failles xss et on les place dans des variables qu'on à nommées
        $id = htmlspecialchars($_GET["id"]);
        $GETemail = htmlspecialchars($_GET["email"]);
    }
    

    // si un email à été posté et existe
    if(isset($_POST["email"])){

        // on le passe en htmlspecialchars
        $email = htmlspecialchars($_POST["email"]);

    // si l'email n'est pas vide dans l'input
        if($email !== ''){

            // on prepare et execute dans la table users le nouvel email choisis et post
            $edit = $pdo->prepare("UPDATE users SET email = ? WHERE id = ?");
            $edit->execute([$email, $id]);

            // si réussite :
            header("Location: ../profil.php?success=modification réussi !");

        }
        else{
            // si erreur :
            $error = "veuillez remplir les champs";
        }
    }


    
// update du password
    if(isset($_GET["password"]) && isset($_GET["id"])){

        // on les passe en htmlspecialchars pour empecher les failles xss et on les place dans des variables qu'on à nommées
        $id = htmlspecialchars($_GET["id"]);
        $GETpassword = htmlspecialchars($_GET["password"]);
    }
    

    // si un password à été posté et existe
    if(isset($_POST["password"])){

        // on le passe en htmlspecialchars
        $password = htmlspecialchars($_POST["password"]);

        // on hash le password par sécurité
        $password = password_hash($password, PASSWORD_DEFAULT);

        // si le password n'est pas vide dans l'input
        if($password !== ''){

            // on prepare et execute dans la table users le nouveau password choisis et post
            $edit = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
            $edit->execute([$password, $id]);

            // si réussite :
            header("Location: ../profil.php?success=modification réussi !");

        }
        else{
            // si erreur :
            $error = "veuillez remplir les champs";
        }
    }



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Modifier mon profil</h1>

    <div class='data'>
        <p>Login actuel : <?php

            if(isset($_GET["user_name"])){
                echo htmlspecialchars($_GET["user_name"]);
            }
        
        
        ?></p>
    </div>

    <form action="" method="POST">
        <input type="text" placeholder="Entrez le nouveau login" name="user_name" value="<?php
            if(isset($_GET["user_name"])){
                echo htmlspecialchars($_GET["user_name"]);
            }

        ?>">
        <input type="submit" value="Modifier">
    </form>


<!-- modification de l'email -->    
    <div class='data'>
        <p>Email actuel : <?php

            if(isset($_GET["email"])){
                echo htmlspecialchars($_GET["email"]);
            }
        
        
        ?></p>
    </div>

    <form action="" method="POST">
        <input type="text" placeholder="Entrez le nouvel email" name="email" value="<?php
            if(isset($_GET["email"])){
                echo htmlspecialchars($_GET["email"]);
            }

        ?>">
        <input type="submit" value="Modifier">
    </form>


<!-- modification du password -->
    <div class='data'>
        <p>Password actuel : <?php

            if(isset($_GET["password"])){
                echo htmlspecialchars($_GET["password"]);
            }
        
        
        ?></p>
    </div>

    <form action="" method="POST">
        <input type="text" placeholder="Entrez le nouveau password" name="password" value="<?php
            if(isset($_GET["password"])){
                echo htmlspecialchars($_GET["password"]);
            }

        ?>">
        <input type="submit" value="Modifier">
    </form>

    
    
</body>
</html> 
<?php 

    session_start();

    // connexion à la base de donnée
    require_once 'modele/database.php';
    
   // si la session existe pas soit si l'on est pas connecté on redirige
    if(!isset($_SESSION['user_name'])){
        header('Location:index.php');
        die();
    }

?>


<!doctype html>
<html lang="en">
<head>
     
    <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <title>Espace membre</title>
</head>
<body>


<?php require 'header.php' ?>

      <div class="text-center">
              <h4 class="p-3 mt-5 mb-5">Voulez-vous nous quitter <?php echo $_SESSION['user_name']; ?> ? Si oui, cliquez sur le bouton ci dessous.</h4>
             <a href="functions/deconnexion.php" class="btn btn-danger btn-lg mb-5">Déconnexion</a>
       </div>


<?php require_once 'footer.php' ?>


</body>
</html>
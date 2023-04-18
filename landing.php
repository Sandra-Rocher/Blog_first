<?php 
    session_start();

    // connexion à la base de donnée
    require_once 'functions/database.php';
    
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
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Espace membre</title>
</head>
<body>

<!-- lien header navbar -->
<?php require 'header.php' ?>

      <div class="text-center">
              <h4 class="p-3 mt-5">Voulez-vous nous quitter <?php echo $_SESSION['user_name']; ?> ? Si oui, cliquez sur le bouton ci dessous.</h4>
             <a href="functions/deconnexion.php" class="btn btn-danger btn-lg mb-5">Déconnexion</a>
       </div>

<!-- lien footer -->
<?php require_once 'footer.php' ?>


</body>
</html>
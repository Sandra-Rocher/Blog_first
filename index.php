
<?php

SESSION_start();


// connexion avec la database
require_once 'functions/database.php';


// récupération de tous les articles DE TOUT LE MONDE REUNIS
$sql = 'SELECT * FROM articles
                JOIN users
                ON articles.id_users=users.id
                ORDER BY date_articles DESC';

$requete = $pdo->query($sql);
$articles = $requete->fetchAll();


?>


<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- lien bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <title>Accueil</title>
</head>
<body>
<!-- lien header navbar -->
<?php require 'header.php' ?>
      
 <div class="fs-3 fw-bold text-center mt-5 mb-5">Bienvenue sur la page de tous les articles partagés par ordre d'actualité.</div>

             <div class="container mt-5 mb-5">
                <div class="row">

<?php
    foreach($articles as $article){

  echo     ' 
                     <div class="col-sm-12 col-md-12 col-lg-5 mx-auto mb-5">

                        <div class="card mx-auto border border-info shadow-lg">
                            <p class="card-text mx-auto mt-3"><small class="text-info">Publié le '. $article["date_articles"] . ' par <span class="fw-bold"> '. $article ["user_name"] . ' </span></small></p>
                            <h5 class="card-title text-center"> ' . $article ["title"] . ' </h5>
                            <img src= stock_avatar/' . $article ["image"] . ' class="card-img-top" alt=" '. $article ["title"] . '">
                            <div class="card-body mx-auto">
                                <p class="card-text"> ' . $article ["content"] . ' </p>
                                <a href="#" class="btn btn-info d-flex justify-content-center mb-3" >Voir l\'article en entier</a>
                            </div>
                        </div>
                    </div>
                ';
 }
?>

                </div>
             </div>

<!-- lien footer -->
<?php require_once 'footer.php' ?>
<!-- lien bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
 
</body>
</html>